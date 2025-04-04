<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Árbol Genealógico</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Árbol Genealógico</h1>
    <input type="text" id="search" placeholder="Buscar por nombre">
    <svg id="treeSvg"></svg>
    <div id="infoCard" class="info-card"></div>
    <div id="tooltip" class="tooltip"></div>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script>
        const svg = d3.select("#treeSvg");
        const width = +svg.node().clientWidth;
        const height = 600;
        svg.attr("width", width).attr("height", height);
        const g = svg.append("g").attr("transform", "translate(50,50)");
        const nodeWidth = 200;
        const nodeHeight = 140;
        const treeLayout = d3.tree().size([width - 150, height - 100]);
        let root;
        let nodeMap = new Map();
        const zoom = d3.zoom()
            .scaleExtent([0.1, 3])
            .on("zoom", zoomed);
        svg.call(zoom);

        function zoomed(event) {
            g.attr("transform", event.transform);
        }

        function countChildren(d) {
            if (!d.children) {
                return 0;
            }
            let count = d.children.length;
            d.children.forEach(child => {
                count += countChildren(child);
            });
            return count;
        }

        function getSponsorName(d) {
            if (!d.parent || !d.parent.data) {
                return "Sin Patrocinador";
            }
            return d.parent.data.nombre;
        }

        function showInfoCard(d, event) {
            const card = d3.select("#infoCard");
            card.html(`
                <img src="${d.data.foto ? d.data.foto : 'https://cdn-icons-png.flaticon.com/512/847/847969.png'}" alt="User Image">
                <h2>${d.data.nombre}</h2>
                <p>ID: ${d.data.id}</p>
                <p>Correo electrónico: ${d.data.email || 'No disponible'}</p>
                <p>Descripción: ${d.data.descripcion || 'No disponible'}</p>
                <p>Patrocinador: ${getSponsorName(d)}</p>
                <p>Patrocinados: ${countChildren(d)}</p>
            `);
            card.style("display", "block")
                .style("left", (event.pageX + 20) + "px")
                .style("top", (event.pageY - 20) + "px");
        }

        function update(source) {
            treeLayout(root);
            const links = g.selectAll(".link")
                .data(root.links(), d => d.target.data.id);
            links.join(
                enter => enter.append("path")
                    .attr("class", "link")
                    .attr("d", d3.linkVertical()
                        .x(d => d.x)
                        .y(d => d.y)),
                update => update.attr("d", d3.linkVertical()
                        .x(d => d.x)
                        .y(d => d.y)),
                exit => exit.remove()
            );

            const nodes = g.selectAll(".node")
                .data(root.descendants(), d => d.data.id);
            const nodeEnter = nodes.enter()
                .append("g")
                .attr("class", "node")
                .attr("transform", d => `translate(${d.x - nodeWidth/2}, ${d.y - nodeHeight/2})`)
                .on("click", function(event, d) {
                    showInfoCard(d, event);
                    event.stopPropagation();
                })
                .on("mouseover", function(event, d) {
                    d3.select("#tooltip")
                        .style("display", "block")
                        .style("left", (event.pageX + 10) + "px")
                        .style("top", (event.pageY - 10) + "px")
                        .html(`<b>${d.data.nombre}</b><br>ID: ${d.data.id}<br>Patrocinador: ${getSponsorName(d)}`);
                })
                .on("mouseout", function() {
                    d3.select("#tooltip").style("display", "none");
                });

            nodeEnter.append("rect")
                .attr("width", nodeWidth)
                .attr("height", nodeHeight);

            nodeEnter.append("image")
                .attr("xlink:href", d => d.data.foto ? d.data.foto : "https://cdn-icons-png.flaticon.com/512/847/847969.png")
                .attr("x", 10)
                .attr("y", 10);

            nodeEnter.append("text")
                .attr("x", 60)
                .attr("y", 30)
                .text(d => d.data.nombre ? d.data.nombre : "Usuario");

            nodeEnter.append("text")
                .attr("x", 60)
                .attr("y", 50)
                .text(d => d.data.id ? "ID: " + d.data.id : "");

            nodeEnter.append("text")
                .attr("x", 60)
                .attr("y", 70)
                .text(d => "Patrocinador: " + getSponsorName(d));

            nodeEnter.append("text")
                .attr("x", 60)
                .attr("y", 90)
                .text(d => "Patrocinados: " + countChildren(d));

            // Solo mostrar botón de expandir si tiene hijos
            nodeEnter.filter(d => d._children || d.children)
                .append("foreignObject")
                .attr("x", nodeWidth - 40)
                .attr("y", nodeHeight - 30)
                .attr("width", 30)
                .attr("height", 30)
                .append("xhtml:body")
                .html("<button class='expandir'>+</button>")
                .on("click", function(event, d) {
                    event.stopPropagation();
                    // Alternar solo el primer nivel de hijos
                    if (d.children) {
                        // Contraer: guardar hijos en _children y eliminar children
                        d._children = d.children;
                        d.children = null;
                    } else {
                        // Expandir: restaurar hijos desde _children
                        d.children = d._children;
                        d._children = null;
                    }
                    update(d);
                });

            nodes.merge(nodeEnter)
                .transition()
                .duration(500)
                .attr("transform", d => `translate(${d.x - nodeWidth/2}, ${d.y - nodeHeight/2})`);

            nodes.exit().remove();
        }

        d3.json("datos.php").then(data => {
            root = d3.hierarchy(data, d => d.children);
            root.descendants().forEach(d => {
                // Guardar copia de los hijos originales en _children
                if (d.children) {
                    d._children = d.children;
                    d.children = null; // Inicialmente contraído
                }
                nodeMap.set(d.data.id, d);
            });
            // Expandir solo el nodo raíz inicialmente
            if (root._children) {
                root.children = root._children;
                root._children = null;
            }
            update(root);
        }).catch(error => {
            console.error("Error al cargar datos:", error);
        });

        window.addEventListener('resize', () => {
            const newWidth = svg.node().clientWidth;
            svg.attr('width', newWidth);
            treeLayout.size([newWidth - 150, height - 100]);
            update(root);
        });

        document.addEventListener('click', function(event) {
            if (event.target.closest('.node')) return;
            d3.select('#infoCard').style('display', 'none');
        });

        d3.select("#search").on("input", function() {
            const searchTerm = this.value.toLowerCase();
            g.selectAll(".node")
                .style("display", d => d.data.nombre.toLowerCase().includes(searchTerm) ? "block" : "none");
        });
    </script>
</body>
</html>