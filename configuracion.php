<?php

$modulos = [];
$modulos["reporte_lista_producto"] = [
    "ruta" => "modulos/reporte_lista_producto/",

    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
        "descarga" => [
            "archivo" => "descarga.php", 
            "diseño" => "descarga"
        ],
        
    ]
];

$modulos["reporte_producto_por_vencer"] = [
    "ruta" => "modulos/reporte_producto_por_vencer/",

    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
        "descarga" => [
            "archivo" => "descarga.php",
            "diseño" => "descarga"
        ],
        
    ]
];

$modulos["reporte_producto_presentacion"] = [
    "ruta" => "modulos/reporte_producto_presentacion/",
    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
        "descarga" => [
            "archivo" => "descarga.php",
            "diseño" => "descarga"
        ],
        
    ]
];
$modulos["reportes_producto_salida"] = [
    "ruta" => "modulos/reportes_producto_salida/",

    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
        "descarga" => [
            "archivo" => "descarga.php",
            "diseño" => "descarga"
        ],
        
    ]
];
$modulos["reporte_persona_municipio"] = [
    "ruta" => "modulos/reporte_persona_municipio/",

    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
        "descarga" => [
            "archivo" => "descarga.php",
            "diseño" => "descarga"
        ],
        
    ]
];
$modulos["reporte_empleado"] = [
    "ruta" => "modulos/reporte_empleado/",
 
    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
        "descarga" => [
            "archivo" => "descarga.php",
            "diseño" => "descarga"
        ],
        
    ]
];
$modulos["reportes_pedidos"] = [
    "ruta" => "modulos/reportes_pedidos/",
 
    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
        "descarga" => [
            "archivo" => "descarga.php",
            "diseño" => "descarga"
        ],
        
    ]
];
$modulos["reporte_proveedor"] = [
    "ruta" => "modulos/reporte_proveedores/",
   
    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
        "descarga" => [
            "archivo" => "descarga.php",
            "diseño" => "descarga"
        ],
        
    ]
];


$modulos["iniciar-sesion"] = [
    "ruta" => "modulos/iniciar_sesion/",
        "no_pedir_permiso" => true,
    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
        "iniciar" => [
            "archivo" => "iniciar.php",
            "diseño" => "json"
        ],      
    ]
];
$modulos["recuperar_clave"] = [
    "ruta" => "modulos/recuperar_clave/",
        "no_pedir_permiso" => true,
    "acciones" => [
        "ver" => [
            "archivo" => "formulario_reuperar.php",
            "diseño" => "pagina"
        ],
        "recupera" => [
            "archivo" => "recuperar.php",
            "diseño" => "json"
        ],      
    ]
];

$modulos["crear-usuario"] = [
    "ruta" => "modulos/crear_usuario/",
            "no_pedir_permiso" => true,

    "acciones" => [
        "ver" => [
            "archivo" => "crear_usuario.php",
            "diseño" => "pagina"
        ],
            "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],
     
    ]
];
$modulos["actualizar_clave"] = [
    "ruta" => "modulos/actualizar_clave/",
            "no_pedir_permiso" => true,

    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
            "cambiar" => [
            "archivo" => "cambiar.php",
            "diseño" => "json"
        ],
     
    ]
];
$modulos["permiso-cargo"] = [
    "ruta" => "modulos/permiso_cargo/",

    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
            "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],
     
    ]
];

$modulos["actualizar_datos_personales"] = [
    "ruta" => "modulos/actualizar_datos_personales/",
            "no_pedir_permiso" => true,

    "acciones" => [
        "ver" => [
            "archivo" => "formulario.php",
            "diseño" => "pagina"
        ],
        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ]

    ]
];

$modulos["cerrar-sesion"] = [
    "ruta" => "modulos/cerrar_sesion/",
        "no_pedir_permiso" => true,

    "acciones" => [
      "ver" => [
            "archivo" => "salir.php",
            "diseño" => "html"
        ] 
    ]
];

$modulos["contenido1"] = [
    "ruta" => "modulos/formulario/",
        "no_pedir_permiso" => true,
    "acciones" => [
        "ver" => [
            "archivo" => "contenido1.php",
            "diseño" => "pagina"
        ]
    ]
];

$modulos["mision"] = [
    "ruta" => "modulos/formulario/",
        "no_pedir_permiso" => true,

    "acciones" => [
        "ver" => [
            "archivo" => "mision",
            "diseño" => "pagina-contenido"
        ]
    ]
];

$modulos["vision"] = [
    "ruta" => "modulos/formulario/",
        "no_pedir_permiso" => true,

    "acciones" => [
        "ver" => [
            "archivo" => "vision",
            "diseño" => "pagina-contenido"
        ]
    ]
    ];
    
    $modulos["objetivo"] = [
    "ruta" => "modulos/formulario/",
        "no_pedir_permiso" => true,

    "acciones" => [
        "ver" => [
            "archivo" => "objetivo",
            "diseño" => "pagina-contenido"
        ]
    ]
    ];


    
      $modulos["organigrama"] = [
    "ruta" => "modulos/formulario/",
            "no_pedir_permiso" => true,

    "acciones" => [
        "ver" => [
            "archivo" => "organigrama",
            "diseño" => "pagina-contenido"
        ]
    ]
];


$modulos["reporte_productos"] = [
    "ruta" => "modulos/reporte_productos/",
            "no_pedir_permiso" => true,

    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["departamentos"] = [
    "ruta" => "modulos/departamentos/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["municipio"] = [
    "ruta" => "modulos/municipio/",
                "no_pedir_permiso" => true,

    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["cargo"] = [
    "ruta" => "modulos/cargo/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["presentacion"] = [
    "ruta" => "modulos/presentacion/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["usuario"] = [
    "ruta" => "modulos/usuario/",
                "no_pedir_permiso" => true,

    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["persona"] = [
    "ruta" => "modulos/persona/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["producto"] = [
    "ruta" => "modulos/productos/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["pedido_producto"] = [
    "ruta" => "modulos/pedido_producto/",

    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["tipo_identificacion"] = [
    "ruta" => "modulos/tipo_identificacion/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 
        

    ]
];
$modulos["proveedor"] = [
    "ruta" => "modulos/proveedor/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 
        

    ]
];
$modulos["producto_salida"] = [
    "ruta" => "modulos/producto_salida/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 
        

    ]
];
$modulos["permiso-cargo"] = [
    "ruta" => "modulos/permiso_cargo/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 


    ]
];
$modulos["unidad_medida"] = [
    "ruta" => "modulos/unidad_medida/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["via_administracion"] = [
    "ruta" => "modulos/via_administracion/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["salida"] = [
    "ruta" => "modulos/salida/",

    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["pedido"] = [
    "ruta" => "modulos/pedido/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["producto_reporte_vencimiento"] = [
    "ruta" => "modulos/producto_reporte_vencimiento/",
            "no_pedir_permiso" => true,

    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["empleado"] = [
    "ruta" => "modulos/empleado/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["reporte_vencimiento"] = [
    "ruta" => "modulos/reporte_vencimiento/",
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
$modulos["contenido"] = [
    "ruta" => "modulos/contenido/",
            "no_pedir_permiso" => true,
    "acciones" => [
        "ver" => [
            "archivo" => "index.php",
            "diseño" => "pagina"
        ],
        "listar" => [
            "archivo" => "tabla.php",
            "diseño" => "html"
        ],

        "asignar" => [
            "archivo" => "asignar.php",
            "diseño" => "json"
        ],

        "agregar" => [
            "archivo" => "agregar.php",
            "diseño" => "json"
        ],

        "modificar" => [
            "archivo" => "modificar.php",
            "diseño" => "json"
        ],

        "eliminar" => [
            "archivo" => "eliminar.php",
            "diseño" => "json"
        ] 

    ]
];
