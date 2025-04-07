<!DOCTYPE html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">
<head>
    <meta charset="utf-8" />
    <title>Árbol Genealógico | Velzon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    
    <!-- CSS de Velzon -->
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/simplebar/simplebar.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/node-waves/waves.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css">
    
    <!-- Estilos personalizados para el árbol -->
    <style>
        .genealogy-tree {
            border-radius: 0.5rem;
            background-color: var(--vz-card-bg);
            border: 1px solid var(--vz-border-color);
            box-shadow: var(--vz-box-shadow);
        }

        #tree-container {
            min-height: 700px;
            position: relative;
            overflow: auto;
            background-color: var(--vz-card-bg);
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
            transition: all 0.2s ease;
            filter: drop-shadow(0 2px 4px rgba(var(--vz-primary-rgb), 0.1));
        }

        .node-name {
            fill: var(--vz-gray-800);
            font-family: var(--vz-font-sans-serif);
            font-size: 12px;
            font-weight: 600;
        }

        .node-detail {
            fill: var(--vz-gray-600);
            font-size: 10px;
            font-family: var(--vz-font-sans-serif);
        }

        .expand-btn-circle {
            fill: var(--vz-primary);
            stroke: var(--vz-card-bg);
            cursor: pointer;
            stroke-width: 2px;
        }

        .link {
            stroke: var(--vz-gray-300);
            stroke-width: 1.5px;
            fill: none;
        }

        .info-card {
            background-color: var(--vz-card-bg);
            border: 1px solid var(--vz-border-color);
            box-shadow: var(--vz-box-shadow-lg);
            border-radius: 0.5rem;
            z-index: 1000;
            max-width: 300px;
            padding: 1rem;
        }

        .tree-controls .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.8125rem;
            margin: 0 3px 3px 0;
        }
        
        /* Efecto hover para nodos */
        .node:hover .node-body {
            stroke: var(--vz-danger);
            filter: drop-shadow(0 0 5px rgba(var(--vz-primary-rgb), 0.2));
        }
        
        /* Ajustes para modo oscuro */
        [data-bs-theme="dark"] .node-name {
            fill: var(--vz-gray-300);
        }
        
        [data-bs-theme="dark"] .node-detail {
            fill: var(--vz-gray-500);
        }
        
        [data-bs-theme="dark"] .link {
            stroke: var(--vz-gray-700);
        }
        
        .search-container {
            padding: 1rem;
            border-bottom: 1px solid var(--vz-border-color);
            background-color: var(--vz-card-bg);
        }
        
        .search-box {
            position: relative;
            max-width: 400px;
        }
        
        .search-icon {
            position: absolute;
            right: 10px;
            top: 10px;
            color: var(--vz-secondary-color);
        }
        
        .avatar-circle {
            border: 2px solid var(--vz-primary);
        }
        
        .controls-container {
            padding: 0.5rem 1rem;
            background-color: var(--vz-card-bg);
            border-bottom: 1px solid var(--vz-border-color);
        }
    </style>
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- ========== Header ========== -->
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- Logo -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-dark.png" alt="" height="17">
                                </span>
                            </a>
                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-light.png" alt="" height="17">
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- ========== Sidebar ========== -->
        <div class="vertical-menu">
            <div data-simplebar class="h-100">
                <!--- Menu -->
                <div id="sidebar-menu">
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title" data-key="t-menu">Menu</li>
                        <li>
                            <a href="index.html">
                                <i class="ri-dashboard-2-line"></i>
                                <span data-key="t-dashboard">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">
                                <i class="ri-account-circle-line"></i>
                                <span data-key="t-network">Red</span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="network-list.html" data-key="t-network-list">Lista de Miembros</a></li>
                                <li><a href="genealogy.html" data-key="t-genealogy" class="active">Árbol Genealógico</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- ========== Contenido Principal ========== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Encabezado de página -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">Árbol Genealógico</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Red</a></li>
                                        <li class="breadcrumb-item active">Árbol Genealógico</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contenedor principal -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card genealogy-tree">
                                <!-- Barra superior con búsqueda -->
                                <div class="search-container">
                                    <div class="search-box">
                                        <input type="text" class="form-control" id="search" placeholder="Buscar por nombre o ID...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                
                                <!-- Controles -->
                                <div class="controls-container d-flex flex-wrap">
                                    <button class="btn btn-soft-primary btn-sm" id="expandAll">
                                        <i class="ri-zoom-in-line align-bottom me-1"></i> Expandir
                                    </button>
                                    <button class="btn btn-soft-info btn-sm" id="expandAllSimultaneously">
                                        <i class="ri-folder-open-line align-bottom me-1"></i> Expandir Todo
                                    </button>
                                    <button class="btn btn-soft-warning btn-sm" id="collapseAll">
                                        <i class="ri-zoom-out-line align-bottom me-1"></i> Contraer
                                    </button>
                                    <button class="btn btn-soft-danger btn-sm" id="refreshTree">
                                        <i class="ri-restart-line align-bottom me-1"></i> Actualizar
                                    </button>
                                    <button class="btn btn-soft-success btn-sm" id="fullscreen">
                                        <i class="ri-fullscreen-line align-bottom"></i> Pantalla Completa
                                    </button>
                                </div>
                                
                                <!-- Área del árbol -->
                                <div class="card-body p-0">
                                    <div id="tree-container">
                                        <svg id="treeSvg">
                                            <defs>
                                                <marker id="arrowhead" markerWidth="10" markerHeight="7" 
                                                        refX="10" refY="3.5" orient="auto">
                                                    <polygon points="0 0, 10 3.5, 0 7" fill="var(--vz-gray-400)"/>
                                                </marker>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div id="infoCard" class="info-card position-fixed" style="display: none;"></div>
    
    <!-- Tooltip -->
    <div id="tooltip" class="tooltip position-fixed"></div>

    <!-- Scripts de Velzon -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/app.js"></script>
    
    <!-- D3.js para visualización -->
    <script src="https://d3js.org/d3.v7.min.js"></script>

    <!-- Código del árbol genealógico -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const svg = d3.select("#treeSvg");
        const container = document.getElementById('tree-container');
        const width = container.clientWidth;
        const height = 700;
        svg.attr("width", width).attr("height", height);
        
        const g = svg.append("g");
        
        const nodeWidth = 180;
        const nodeHeight = 100;
        const horizontalSpacing = 200;
        const verticalSpacing = 120;
        
        // Configuración del layout
        const treeLayout = d3.tree()
            .nodeSize([horizontalSpacing, verticalSpacing])
            .separation((a, b) => a.parent === b.parent ? 1 : 1.5);
        
        let root;
        let nodeMap = new Map();
        
        // Zoom y panning
        const zoom = d3.zoom()
            .scaleExtent([0.5, 2])
            .on("zoom", (event) => {
                g.attr("transform", event.transform);
            });

        svg.call(zoom)
           .call(zoom.transform, d3.zoomIdentity.translate(width / 2, 50));

        // Funciones auxiliares
        function countChildren(d) {
            return (d.children?.length || 0) + (d._children?.length || 0);
        }
        
        function getSponsorName(d) {
            return d.parent?.data?.nombre || "Ninguno";
        }
        
        function showInfoCard(d) {
            const card = d3.select("#infoCard");
            card.html(`
                <div class="text-center mb-3">
                    <img src="${d.data.foto || 'assets/images/users/avatar-1.jpg'}" 
                         class="rounded-circle avatar-md border border-primary avatar-circle">
                    <h4 class="mt-2 mb-0">${d.data.nombre || "Usuario"}</h4>
                    <small class="text-muted">ID: ${d.data.id_usuario || "N/A"}</small>
                </div>
                <div class="border-top pt-2">
                    <p class="mb-1"><i class="ri-mail-line me-2"></i> ${d.data.email || "No disponible"}</p>
                    <p class="mb-1"><i class="ri-phone-line me-2"></i> ${d.data.telefono || "No disponible"}</p>
                    <p class="mb-1"><i class="ri-user-star-line me-2"></i> Patrocinador: ${getSponsorName(d)}</p>
                    <p class="mb-0"><i class="ri-team-line me-2"></i> Patrocinados: ${countChildren(d)}</p>
                </div>
                <div class="mt-3 d-flex justify-content-between">
                    <button class="btn btn-sm btn-primary">Ver perfil</button>
                    <button class="btn btn-sm btn-soft-info">Enviar mensaje</button>
                </div>
            `).style("display", "block")
              .style("left", (d3.event.pageX + 10) + "px")
              .style("top", (d3.event.pageY + 10) + "px");
        }

        // Función principal de actualización
        function update(source) {
            treeLayout(root);

            const nodes = root.descendants();
            const links = root.links();
            
            // Generador de enlaces
            const linkGenerator = d3.linkVertical()
                .x(d => d.x)
                .y(d => d.y + (d.source ? -nodeHeight/2 + 15 : nodeHeight/2 - 15));
            
            // Actualización de los enlaces
            const linkPaths = g.selectAll(".link")
                .data(links, d => d.target.data.id_usuario);
                
            linkPaths.enter()
                .append("path")
                .attr("class", "link")
                .attr("marker-end", "url(#arrowhead)")
                .merge(linkPaths)
                .transition()
                .duration(500)
                .attr("d", linkGenerator);
                
            linkPaths.exit().remove();
            
            // Dibujamos los nodos
            const nodeGroups = g.selectAll(".node")
                .data(nodes, d => d.data.id_usuario);
                
            const newNodeGroups = nodeGroups.enter()
                .append("g")
                .attr("class", "node")
                .attr("transform", d => `translate(${d.x},${d.y})`);
                
            // Cuerpo de la tarjeta
            newNodeGroups.append("rect")
                .attr("class", "node-body")
                .attr("width", nodeWidth)
                .attr("height", nodeHeight)
                .attr("x", -nodeWidth/2)
                .attr("y", -nodeHeight/2);

            // Foto del usuario
            newNodeGroups.append("image")
                .attr("xlink:href", d => d.data.foto || "assets/images/users/avatar-1.jpg")
                .attr("x", -nodeWidth/2 + 10)
                .attr("y", -nodeHeight/2 + 10)
                .attr("width", 44)
                .attr("height", 44)
                .attr("clip-path", "circle(22px at center)");
                
            // Contenedor de información
            const infoContainer = newNodeGroups.append("g")
                .attr("transform", `translate(${-nodeWidth/2 + 65},${-nodeHeight/2 + 15})`);
                
            // Nombre
            infoContainer.append("text")
                .attr("class", "node-name")
                .attr("y", 15)
                .text(d => d.data.nombre || "")
                .call(wrap, 100);

            // ID
            infoContainer.append("text")
                .attr("class", "node-detail")
                .attr("y", 30)
                .text(d => `ID: ${d.data.id_usuario || ""}`);

            // Patrocinador
            infoContainer.append("text")
                .attr("class", "node-detail")
                .attr("y", 45)
                .text(d => `Patro: ${getSponsorName(d)}`);
      
            // Patrocinados
            infoContainer.append("text")
                .attr("class", "node-detail")
                .attr("y", 60)
                .text(d => `Patricds: ${countChildren(d)}`);
                
            // Botones de expansión
            const expandButtons = newNodeGroups.filter(d => d._children || d.children)
                .append("g")
                .attr("class", "expand-btn")
                .attr("transform", `translate(0,${nodeHeight/2})`)
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
                .attr("r", 15);
                
            // Texto del botón (+/-)
            expandButtons.append("text")
                .attr("class", "expand-text")
                .attr("text-anchor", "middle")
                .attr("dy", "0.3em")
                .attr("fill", "white")
                .style("font-weight", "bold")
                .text(d => d.children ? "-" : "+");
                
            // Eventos interactivos
            newNodeGroups.on("click", function(event, d) {
                    event.stopPropagation();
                    showInfoCard(d);
                })
                .on("mouseover", function(event, d) {
                    d3.select(this).select("rect").attr("stroke", "var(--vz-danger)");
                    d3.select("#tooltip")
                        .style("display", "block")
                        .style("left", (event.pageX + 10) + "px")
                        .style("top", (event.pageY - 30) + "px")
                        .html(`<b>${d.data.nombre}</b><br>Nivel: ${d.depth}`);
                })
                .on("mouseout", function() {
                    d3.select(this).select("rect").attr("stroke", "var(--vz-primary)");
                    d3.select("#tooltip").style("display", "none");
                });
                
            // Actualización de posición con animación
            nodeGroups.merge(newNodeGroups)
                .transition()
                .duration(500)
                .attr("transform", d => `translate(${d.x},${d.y})`);
                
            nodeGroups.exit().remove();
        }
        
        // Función para ajustar texto
        function wrap(text, maxWidth) {
            text.each(function() {
                const textElement = d3.select(this);
                const words = textElement.text().split(/\s+/);
                let line = [];
                let lineNumber = 0;
                const lineHeight = 1.1;
                const y = textElement.attr("y");
                const dy = parseFloat(textElement.attr("dy") || 0);
                
                textElement.text(null);
                
                let tspan = textElement.append("tspan")
                    .attr("x", 0)
                    .attr("y", y)
                    .attr("dy", dy + "em")
                    .text(words.join(" "));
                
                // Si el texto es demasiado largo, agregar puntos suspensivos
                if (tspan.node().getComputedTextLength() > maxWidth) {
                    textElement.text(null);
                    let str = words.join(" ");
                    let truncated = str;
                    
                    do {
                        truncated = str.substring(0, str.length - 4) + "...";
                        tspan = textElement.append("tspan")
                            .attr("x", 0)
                            .attr("y", y)
                            .attr("dy", dy + "em")
                            .text(truncated);
                        str = truncated;
                    } while (tspan.node().getComputedTextLength() > maxWidth && str.length > 4);
                }
            });
        }

        // Carga de datos inicial
        d3.json("vistas/d3/datos.php").then(data => {
            root = d3.hierarchy(data);
            
            root.descendants().forEach(d => {
                nodeMap.set(d.data.id_usuario, d);
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
            update(root);
            
        }).catch(error => {
            console.error("Error al cargar datos:", error);
            // Mostrar error usando SweetAlert2 de Velzon
            Swal.fire({
                title: 'Error',
                text: 'No se pudo cargar el árbol genealógico',
                icon: 'error',
                confirmButtonText: 'Reintentar',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        });

        // Eventos globales
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.node') && !event.target.closest('#infoCard')) {
                d3.select('#infoCard').style('display', 'none');
            }
        });
        
        // Búsqueda
        d3.select("#search").on("input", function() {
            const term = this.value.toLowerCase();
            g.selectAll(".node")
                .style("opacity", d => 
                    !term || 
                    (d.data.nombre && d.data.nombre.toLowerCase().includes(term)) || 
                    (d.data.id_usuario && d.data.id_usuario.toString().includes(term)) ? 1 : 0.3);
        });
        
        // Redimensionamiento
        window.addEventListener('resize', function() {
            const newWidth = container.clientWidth;
            svg.attr('width', newWidth);
            update(root);
        });

        // Controladores de botones
        document.getElementById("expandAll").addEventListener("click", () => {
            root.descendants().forEach(d => {
                if (d._children && d.depth < 2) {
                    d.children = d._children;
                    d._children = null;
                }
            });
            update(root);
        });

        document.getElementById("collapseAll").addEventListener("click", () => {
            root.descendants().forEach(d => {
                if (d.children && d.depth > 0) {
                    d._children = d.children;
                    d.children = null;
                }
            });
            update(root);
        });

        document.getElementById("fullscreen").addEventListener("click", () => {
            const elem = document.documentElement;
            if (!document.fullscreenElement) {
                elem.requestFullscreen().catch(err => console.error(err));
            } else {
                document.exitFullscreen();
            }
        });

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
            expandRecursively(root);
            update(root);
        });

        document.getElementById("refreshTree").addEventListener("click", () => {
            const refreshBtn = document.getElementById("refreshTree");
            const originalText = refreshBtn.innerHTML;
            refreshBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Cargando...';
            refreshBtn.disabled = true;
            
            g.selectAll("*").remove();
            
            d3.json("vistas/d3/datos.php").then(data => {
                root = d3.hierarchy(data);
                
                root.descendants().forEach(d => {
                    nodeMap.set(d.data.id_usuario, d);
                    if (d.children) {
                        d._children = d.children;
                        d.children = null;
                    }
                });
                
                if (root._children) {
                    root.children = root._children;
                    root._children = null;
                }
                
                treeLayout(root);
                update(root);
                
                refreshBtn.innerHTML = originalText;
                refreshBtn.disabled = false;
                
            }).catch(error => {
                console.error("Error al actualizar:", error);
                refreshBtn.innerHTML = originalText;
                refreshBtn.disabled = false;
                
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo actualizar el árbol',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
    });
    </script>
</body>
</html>