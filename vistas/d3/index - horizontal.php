<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Árbol Genealógico</title>
    <!-- <link rel="stylesheet" href="styles.css"> -->
     <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    background-color: #f4f4f4;
}

h1 {
    margin-bottom: 20px;
}

#search {
    margin-bottom: 10px;
}

svg {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 95%;
    max-width: 1200px;
    height: 600px;
}

.link {
    fill: none;
    stroke: #bbb;
    stroke-width: 2px;
    stroke-dasharray: 5, 5;
}

.node rect {
    fill: #f9f9f9;
    stroke: #ccc;
    stroke-width: 1px;
    rx: 8px;
    ry: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.node text {
    font-size: 12px;
    fill: #333;
}

.node image {
    clip-path: circle(20px at center);
    width: 40px;
    height: 40px;
}

.node button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 5px 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
}

.info-card {
    position: absolute;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 300px;
    display: none;
}

.info-card img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin-bottom: 10px;
}

.tooltip {
    position: absolute;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    display: none;
}
.expandir {
    background-color: #4CAF50; /* Color de fondo verde */
    color: white; /* Color de texto blanco */
    border: none; /* Sin borde */
    border-radius: 50%; /* Forma circular */
    width: 25px; /* Ancho del botón */
    height: 25px; /* Altura del botón */
    font-size: 16px; /* Tamaño de la fuente */
    cursor: pointer; /* Cambiar el cursor al pasar por encima */
    display: flex; /* Usar flexbox para centrar el contenido */
    align-items: center; /* Centrar verticalmente */
    justify-content: center; /* Centrar horizontalmente */
    transition: background-color 0.3s ease; /* Transición suave del color de fondo */
}

.expandir:hover {
    background-color: #3e8e41; /* Color de fondo más oscuro al pasar el ratón */
}
     </style>
</head>
<body>
    <h1>Árbol Genealógico </h1>
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
        const treeLayout = d3.tree().size([height - 100, width - 150]);
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

            card.select("#editButton").on("click", function() {
                // Crear formulario de edición
                card.html(`
                    <img src="${d.data.foto ? d.data.foto : 'https://cdn-icons-png.flaticon.com/512/847/847969.png'}" alt="User Image">
                    <form id="editForm">
                        <input type="hidden" name="id" value="${d.data.id}">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" value="${d.data.nombre}"><br>
                        <label>Correo electrónico:</label>
                        <input type="email" name="email" value="${d.data.email || ''}"><br>
                        <label>Descripción:</label>
                        <textarea name="descripcion">${d.data.descripcion || ''}</textarea><br>
                        <input type="submit" value="Guardar">
                    </form>
                `);

              
            });
        }
        function update(source) {
            treeLayout(root);
            const links = g.selectAll(".link")
                .data(root.links(), d => d.target.data.id);
            links.join(
                enter => enter.append("path")
                    .attr("class", "link")
                    .attr("d", d3.linkHorizontal()
                        .x(d => d.y)
                        .y(d => d.x)),
                update => update.attr("d", d3.linkHorizontal()
                        .x(d => d.y)
                        .y(d => d.x)),
                exit => exit.remove()
            );
            const nodes = g.selectAll(".node")
                .data(root.descendants(), d => d.data.id);
            const nodeEnter = nodes.enter()
                .append("g")
                .attr("class", "node")
                .attr("transform", d => `translate(${d.y - nodeWidth/2}, ${d.x - nodeHeight/2})`)
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
            nodeEnter.append("foreignObject")
                .attr("x", nodeWidth - 40)
                .attr("y", nodeHeight - 30)
                .attr("width", 30)
                .attr("height", 30)
                .append("xhtml:body")
                .html("<button class='expandir'>+</button>")
                .on("click", function(event, d) {
                    d.children = d.children ? null : d._children;
                    update(d);
                    event.stopPropagation();
                });
            nodes.merge(nodeEnter)
                .transition()
                .duration(500)
                .attr("transform", d => `translate(${d.y - nodeWidth/2}, ${d.x - nodeHeight/2})`);
            nodes.exit().remove();
        }
        d3.json("datos.php").then(data => {
            root = d3.hierarchy(data, d => d.children);
            root.descendants().forEach(d => {
                if (d.children) {
                    d._children = d.children;
                }
                nodeMap.set(d.data.id, d);
            });
            update(root);
        }).catch(error => {
            console.error("Error al cargar datos:", error);
        });
        window.addEventListener('resize', () => {
            const newWidth = svg.node().clientWidth;
            svg.attr('width', newWidth);
            treeLayout.size([height - 100, newWidth - 150]);
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