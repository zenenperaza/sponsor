<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Árbol Genealógico</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
    
</head>
<body>
    <h1>Árbol Genealógico</h1>
    <input type="text" id="search" placeholder="Buscar por nombre o ID">
    <svg id="treeSvg">
        <!-- Definición de marcador de flecha -->
        <defs>
            <marker id="arrowhead" markerWidth="10" markerHeight="7" 
                    refX="10" refY="3.5" orient="auto">
                <polygon points="0 0, 10 3.5, 0 7" fill="#bdc3c7"/>
            </marker>
        </defs>
    </svg>
    <div id="infoCard" class="info-card"></div>
    <div id="tooltip" class="tooltip"></div>
    
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script>
         const svg = d3.select("#treeSvg");
        const width = svg.node().clientWidth;
        const height = 700;
        svg.attr("width", width).attr("height", height);
        
        const g = svg.append("g");
        
        const nodeWidth = 180;
        const nodeHeight = 100;
        const horizontalSpacing = 200;
        const verticalSpacing = 120;
        
        // Configuración del layout con ajuste para centrado
        const treeLayout = d3.tree()
            .nodeSize([horizontalSpacing, verticalSpacing])
            .separation((a, b) => a.parent === b.parent ? 1 : 1.5);
        
      
        
        let root;
        let nodeMap = new Map();
        
        // Zoom y panning
       const zoom = d3.zoom()
    .scaleExtent([0.5, 2]) // Ajustar los límites de zoom
    .on("zoom", (event) => {
        g.attr("transform", event.transform);
    });

// Aplicar el zoom sin cambiar la posición
    svg.call(zoom).call(zoom.transform, d3.zoomIdentity.translate(width / 2, 50).scale(1));
        
        // Funciones auxiliares
        function countChildren(d) {
            // Cuenta tanto hijos visibles (children) como ocultos (_children)
            const activeChildren = d.children ? d.children.length : 0;
            const hiddenChildren = d._children ? d._children.length : 0;
            return activeChildren + hiddenChildren;
        }
        
        function getSponsorName(d) {
            if (!d.parent || !d.parent.data) return "Ninguno";
            return d.parent.data.nombre; // Nombre completo sin abreviar
        }
        
        function showInfoCard(d) {
    const card = d3.select("#infoCard");
    card.html(`
        <div style="text-align:center;margin-bottom:15px;">
            <img src="${d.data.foto || 'https://cdn-icons-png.flaticon.com/512/847/847969.png'}" 
                 style="width:80px;height:80px;border-radius:50%;border:3px solid #3498db;">
            <h3 style="margin:5px 0;color:#2c3e50;">${d.data.nombre || "Usuario"}</h3>
            <small style="color:#7f8c8d;">ID: ${d.data.id || "N/A"}</small>
        </div>
        <div style="border-top:1px solid #eee;padding-top:10px;">
            <p><strong>Correo:</strong> ${d.data.email || "No disponible"}</p>
            <p><strong>Teléfono:</strong> ${d.data.telefono || "No disponible"}</p>
            <p><strong>Patrocinador:</strong> ${d.parent?.data?.nombre || "Ninguno"}</p>
            <p><strong>Patrocinados:</strong> ${countChildren(d)}</p>
        </div>
    `);

    // Mostrar la tarjeta en la parte inferior derecha
    card.style("display", "block");
}

        
        // Función principal de actualización
        function update(source) {

            const transform = d3.zoomTransform(svg.node());
            
            treeLayout(root);

            const rootX = width / 2;
            const rootY = 60; // Margen superior

            g.attr("transform", `translate(${rootX - root.x},${rootY})`);

            const nodes = root.descendants();
            const links = root.links();
            
            // Ajuste de los puntos de conexión
            const linkGenerator = d3.linkVertical()
                .x(d => d.x)
                .y(d => {
                    // Si es el nodo padre, conecta en el borde inferior
                    if (d.source) {
                        return d.y - nodeHeight/2 + 15; // Ajuste para conectar debajo del nodo padre
                    }
                    // Si es el nodo hijo, conecta en el borde superior
                    return d.y + nodeHeight/2 - 15;
                });
            
            // Actualización de los enlaces
            const linkPaths = g.selectAll(".link")
                .data(links, d => d.target.data.id);
                
            linkPaths.enter()
                .append("path")
                .attr("class", "link")
                .merge(linkPaths)
                .transition()
                .duration(500)
                .attr("d", linkGenerator);
                
            linkPaths.exit().remove();
            
            // Dibujamos los nodos
            const nodeGroups = g.selectAll(".node")
                .data(nodes, d => d.data.id);
                
            const newNodeGroups = nodeGroups.enter()
                .append("g")
                .attr("class", "node node-card")
                .attr("transform", d => `translate(${d.x},${d.y})`);
                
            // Cuerpo de la tarjeta
            newNodeGroups.append("rect")
                .attr("class", "node-body")
                .attr("width", nodeWidth)
                .attr("height", nodeHeight)
                .attr("x", -nodeWidth/2)
                .attr("y", -nodeHeight/2);


            newNodeGroups.append("image")
                .attr("class", "node-photo")
                .attr("xlink:href", d => d.data.foto || "https://cdn-icons-png.flaticon.com/512/847/847969.png")
                .attr("x", -nodeWidth/2 + 10)
                .attr("y", -nodeHeight/2 + 10)
                .attr("width", 44)
                .attr("height", 44);
                
            // Contenedor de información (mejor organizado)
            const infoContainer = newNodeGroups.append("g")
                .attr("class", "node-info-container")
                .attr("transform", `translate(${-nodeWidth/2 + 65},${-nodeHeight/2 + 15})`);
                


                
            // nombre
            infoContainer.append("text")
                .attr("class", "node-name")
                .attr("y", 15)
                .text(d => `${d.data.nombre || ""}`);

            // ID
            infoContainer.append("text")
                .attr("class", "node-detail")
                .attr("y", 30)
                .text(d => `ID: ${d.data.id || ""}`);


            infoContainer.append("text")
                .attr("class", "sponsor-info")
                .attr("y", 45)
                .text(d => `Patro: ${getSponsorName(d)}`)
                .call(wrap, 100); // Ajusta el ancho máximo
      
                
            // Patrocinados
            infoContainer.append("text")
                .attr("class", "sponsor-info")
                .attr("y", 60)
                .text(d => `Patricds: ${countChildren(d)}`);
                
                const expandButtons = newNodeGroups.filter(d => d._children || d.children)
                .append("g")
                .attr("class", "expand-btn")
                .attr("transform", `translate(0,${nodeHeight/2})`) // Centro en el borde inferior
                .on("click", function(event, d) {
                    event.stopPropagation();
                    if (d.children) {
                        d._children = d.children;
                        d.children = null;
                    } else {
                        d.children = d._children;
                        d._children = null;
                    }
                    update(d);
                });
                
                expandButtons.append("circle")
                .attr("class", "expand-btn-circle")
                .attr("r", 15)
                .attr("cy", 0); // Centro exacto en el borde
                
                // Texto del botón (+/-)
                expandButtons.append("text")
                    .attr("class", "expand-text")
                    .attr("y", 0)
                    .text(d => d.children ? "-" : "+");
                
            // Eventos interactivos
            newNodeGroups.on("click", function(event, d) {
                    showInfoCard(d, event);
                    event.stopPropagation();
                })
                .on("mouseover", function(event, d) {
                    d3.select(this).select("rect").attr("stroke", "#e74c3c");
                    d3.select("#tooltip")
                        .style("display", "block")
                        .style("left", (event.pageX + 10) + "px")
                        .style("top", (event.pageY - 30) + "px")
                        .html(`<b>${d.data.nombre}</b><br>Nivel: ${d.depth}`);
                })
                .on("mouseout", function() {
                    d3.select(this).select("rect").attr("stroke", "#3498db");
                    d3.select("#tooltip").style("display", "none");
                });
                
            // Actualización de posición con animación
            nodeGroups.merge(newNodeGroups)
                .transition()
                .duration(500)
                .attr("transform", d => `translate(${d.x},${d.y})`);
                
            // Actualizar botones de expandir
            g.selectAll(".expand-btn text")
                .text(d => d.children ? "-" : "+");
                
            nodeGroups.exit().remove();

            svg.call(zoom.transform, transform);
        }
        
        // Carga de datos inicial
        d3.json("datos.php").then(data => {
            root = d3.hierarchy(data);
            
            root.descendants().forEach(d => {
                nodeMap.set(d.data.id, d);
                if (d.children) {
                    d._children = d.children;
                    d.children = null;
                }
            });
            
             // Expandir solo el nodo raíz
             if (root._children) {
                root.children = root._children;
                root._children = null;
            }
            
             // Calcular layout inicial
             treeLayout(root);
            
            // Centrar el árbol
            update(root);
            
            
        }).catch(error => {
            console.error("Error al cargar datos:", error);
            alert("Error al cargar el árbol genealógico");
        });

        
        // Eventos globales
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.node') && !event.target.closest('.info-card')) {
                d3.select('#infoCard').style('display', 'none');
            }
        });
        
        d3.select("#search").on("input", function() {
            const term = this.value.toLowerCase();
            g.selectAll(".node")
                .style("opacity", d => 
                    !term || 
                    (d.data.nombre && d.data.nombre.toLowerCase().includes(term)) || 
                    (d.data.id && d.data.id.toString().includes(term)) ? 1 : 0.3);
        });
        
        window.addEventListener('resize', function() {
            const newWidth = svg.node().clientWidth;
            svg.attr('width', newWidth);
            update(root);
        });

         // Función auxiliar para manejar texto largo
         function wrap(text, width) {
            text.each(function() {
                const text = d3.select(this);
                const words = text.text().split(/\s+/).reverse();
                let word;
                let line = [];
                let lineNumber = 0;
                const lineHeight = 1.1;
                const y = text.attr("y");
                const dy = parseFloat(text.attr("dy"));
                let tspan = text.text(null).append("tspan")
                    .attr("x", 0)
                    .attr("y", y)
                    .attr("dy", dy + "px");
                
                while (word = words.pop()) {
                    line.push(word);
                    tspan.text(line.join(" "));
                    if (tspan.node().getComputedTextLength() > width) {
                        line.pop();
                        tspan.text(line.join(" "));
                        line = [word];
                        tspan = text.append("tspan")
                            .attr("x", 0)
                            .attr("y", y)
                            .attr("dy", ++lineNumber * lineHeight + dy + "px")
                            .text(word);
                    }
                }
            });
        }
    </script>
</body>
</html>