
    
    <!-- Estilos personalizados para el árbol -->
    <style>
        .genealogy-tree-card {
            border: 1px solid var(--vz-border-color);
            border-radius: 0.5rem;
            background: var(--vz-card-bg);
        }

        #tree-container {
            min-height: 700px;
            position: relative;
            overflow: auto;
        }

        #treeSvg {
            width: 100%;
            height: 700px;
            background: transparent;
        }

        .node-body {
            fill: var(--vz-card-bg);
            stroke: var(--vz-primary);
            stroke-width: 1.5px;
            rx: 8px;
            ry: 8px;
        }

        .node-name {
            fill: var(--vz-primary);
            font-family: var(--vz-font-sans-serif);
            font-size: 12px;
        }

        .node-detail {
            fill: var(--vz-secondary-color);
            font-size: 10px;
        }

        .expand-btn-circle {
            fill: var(--vz-primary);
            stroke: var(--vz-card-bg);
        }

        .link {
            stroke: var(--vz-border-color);
        }

        .info-card {
            background: var(--vz-card-bg);
            border: 1px solid var(--vz-border-color);
            box-shadow: var(--vz-box-shadow);
            border-radius: 0.5rem;
            z-index: 1000;
        }

        .tree-controls .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- Header y sidebar de Velzon (mantener estructura original) -->
        
        <!-- Contenido principal -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Encabezado -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Árbol Genealógico</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Red</a></li>
                                        <li class="breadcrumb-item active">Árbol Genealógico</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta contenedora -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card genealogy-tree-card">
                                <div class="card-header">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-4">
                                            <input type="search" 
                                                   class="form-control" 
                                                   id="search" 
                                                   placeholder="Buscar por nombre o ID">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-flex gap-2 justify-content-end tree-controls">
                                                <button class="btn btn-soft-primary" id="expandAll">
                                                    <i class="ri-zoom-in-line align-bottom"></i> Expandir
                                                </button>
                                                <button class="btn btn-soft-info" id="expandAllSimultaneously">
                                                    <i class="ri-folder-open-line align-bottom"></i> Expandir Todo
                                                </button>
                                                <button class="btn btn-soft-warning" id="collapseAll">
                                                    <i class="ri-zoom-out-line align-bottom"></i> Contraer
                                                </button>
                                                <button class="btn btn-soft-danger" id="refreshTree">
                                                    <i class="ri-restart-line align-bottom"></i> Actualizar
                                                </button>
                                                <button class="btn btn-soft-success" id="fullscreen">
                                                    <i class="ri-fullscreen-line align-bottom"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div id="tree-container">
                                        <svg id="treeSvg"></svg>
                                        <div id="infoCard" class="info-card position-fixed p-3" style="display: none;"></div>
                                        <div id="tooltip" class="tooltip position-fixed"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Código del árbol genealógico -->
      
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
            .scaleExtent([0.5, 2]) // Limita el zoom para evitar que se haga demasiado grande o pequeño
            .on("zoom", (event) => {
                g.attr("transform", event.transform);
            });

        svg.call(zoom);

        // Mantener la posición inicial sin alterar zoom al actualizar
        const initialTransform = d3.zoomIdentity.translate(width / 2, 50).scale(1);
        svg.call(zoom.transform, initialTransform);

        
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
            
            treeLayout(root);

            const rootX = width / 2;
            const rootY = 60; // Margen superior

            const transform = d3.zoomTransform(svg.node());
            g.attr("transform", `translate(${transform.x}, ${transform.y}) scale(${transform.k})`);

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
                .text(d => `${d.data.nombre || ""}`)                
                .call(wrap, 100); // Ajusta el ancho máximo;

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
                    event.stopPropagation(); // Evita que el clic afecte el zoom
                    showInfoCard(d, event);
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
        d3.json("vistas/d3/datos.php").then(data => {
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

        function wrap(text, maxWidth) {
            text.each(function() {
                const textElement = d3.select(this);
                const content = textElement.text();
                const y = textElement.attr("y");
                const dy = parseFloat(textElement.attr("dy") || 0);
                
                // Limpiar el texto existente
                textElement.text(null);
                
                // Medir el texto completo
                const testSpan = textElement.append("tspan")
                    .text(content)
                    .style("visibility", "hidden");
                
                const textWidth = testSpan.node().getComputedTextLength();
                testSpan.remove();
                
                // Si el texto cabe, mostrarlo completo
                if (textWidth <= maxWidth) {
                    textElement.append("tspan")
                        .attr("x", 0)
                        .attr("y", y)
                        .attr("dy", dy + "em")
                        .text(content);
                    return;
                }
                
                // Función para calcular el ancho del texto con puntos suspensivos
                function getEllipsisWidth(text) {
                    const t = textElement.append("tspan")
                        .text(text)
                        .style("visibility", "hidden");
                    const w = t.node().getComputedTextLength();
                    t.remove();
                    return w;
                }
                
                // Encontrar el punto óptimo para cortar el texto
                let startLength = Math.floor(content.length * 0.4); // 40% del nombre al inicio
                let endLength = Math.floor(content.length * 0.3);  // 30% del nombre al final
                
                let bestFit = null;
                let bestFitWidth = 0;
                
                // Ajustar iterativamente para encontrar el mejor corte
                for (let i = 0; i < 5; i++) {
                    const startText = content.substring(0, startLength);
                    const endText = content.substring(content.length - endLength);
                    const ellipsisText = startText + "..." + endText;
                    const ellipsisWidth = getEllipsisWidth(ellipsisText);
                    
                    if (ellipsisWidth <= maxWidth && ellipsisWidth > bestFitWidth) {
                        bestFit = ellipsisText;
                        bestFitWidth = ellipsisWidth;
                    }
                    
                    // Ajustar proporciones para la siguiente iteración
                    if (ellipsisWidth > maxWidth) {
                        startLength = Math.max(1, startLength - 1);
                        endLength = Math.max(1, endLength - 1);
                    } else {
                        startLength = Math.min(content.length - endLength - 3, startLength + 1);
                        endLength = Math.min(content.length - startLength - 3, endLength + 1);
                    }
                }
                
                // Si encontramos un buen ajuste, usarlo
                if (bestFit) {
                    textElement.append("tspan")
                        .attr("x", 0)
                        .attr("y", y)
                        .attr("dy", dy + "em")
                        .text(bestFit);
                } else {
                    // Si no, dividir en dos líneas
                    const midPoint = Math.floor(content.length / 2);
                    textElement.append("tspan")
                        .attr("x", 0)
                        .attr("y", y)
                        .attr("dy", dy + "em")
                        .text(content.substring(0, midPoint));
                    
                    textElement.append("tspan")
                        .attr("x", 0)
                        .attr("y", y)
                        .attr("dy", dy + 1.1 + "em")
                        .text(content.substring(midPoint));
                }
            });
        }

            // Expandir todos los nodos
        document.getElementById("expandAll").addEventListener("click", () => {
            root.descendants().forEach(d => {
                if (d._children) {
                    d.children = d._children;
                    d._children = null;
                }
            });
            update(root);
        });

        // Contraer todos los nodos
            document.getElementById("collapseAll").addEventListener("click", () => {
                root.descendants().forEach(d => {
                    if (d.children && d.depth > 0) {
                        d._children = d.children;
                        d.children = null;
                    }
                });
                update(root);
            });

        // Pantalla completa
            document.getElementById("fullscreen").addEventListener("click", () => {
                const elem = document.documentElement;
                if (!document.fullscreenElement) {
                    elem.requestFullscreen().catch(err => console.error(err));
                } else {
                    document.exitFullscreen();
                }
            });

        // Expandir todos los nodos simultáneamente
            document.getElementById("expandAllSimultaneously").addEventListener("click", () => {
                function expandRecursively(d) {
                    if (d._children) {
                        d.children = d._children;
                        d._children = null;
                    }
                    if (d.children) {
                        d.children.forEach(expandRecursively);
                    }
                }
                expandRecursively(root); // Iniciar expansión desde la raíz
                update(root);
            });
        // Agregar este código junto con los otros event listeners de botones
            document.getElementById("refreshTree").addEventListener("click", () => {
                // Mostrar un indicador de carga
                const refreshBtn = document.getElementById("refreshTree");
                refreshBtn.innerHTML = "⏳ Cargando...";
                refreshBtn.disabled = true;
                
                // Limpiar el SVG temporalmente
                g.selectAll("*").remove();
                
                // Volver a cargar los datos
                d3.json("vistas/d3/datos.php").then(data => {
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
                    
                    // Calcular layout y actualizar
                    treeLayout(root);
                    update(root);
                    
                    // Restaurar el botón
                    refreshBtn.innerHTML = "🔄 Actualizar Árbol";
                    refreshBtn.disabled = false;
                    
                }).catch(error => {
                    console.error("Error al actualizar:", error);
                    alert("Error al actualizar el árbol");
                    refreshBtn.innerHTML = "🔄 Actualizar Árbol";
                    refreshBtn.disabled = false;
                });
            });
    </script>
</body>
</html>