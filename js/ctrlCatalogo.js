
Ext.require([
    'Ext.plugin.Viewport'
]);
Ext.namespace('Ext.datos');

//Formulario
Ext.datos.Linea = [
    { "nLinea": "0", "sDescrip": "Todos" },
    { "nLinea": "1", "sDescrip": "Pasteles" },
    { "nLinea": "2", "sDescrip": "Galletas" },
    { "nLinea": "3", "sDescrip": "Gelatinas" },
    { "nLinea": "4", "sDescrip": "Panquesitos" }
];

Ext.datos.Tipo = [
    { "nTipo": 0, "sDescrip": "Todos" },
    { "nTipo": 1, "sDescrip": "Normal" },
    { "nTipo": 2, "sDescrip": "Dietético" },
    { "nTipo": 3, "sDescrip": "Diabético" },
    { "nTipo": 4, "sDescrip": "Vegano" }
];

//Dialogos
Ext.datos.LineaD = [
    { "nLineaD": "1", "sDescrip": "Pasteles" },
    { "nLineaD": "2", "sDescrip": "Galletas" },
    { "nLineaD": "3", "sDescrip": "Gelatinas" },
    { "nLineaD": "4", "sDescrip": "Panquesitos" }
];

Ext.datos.TipoD = [
    { "nTipoD": 1, "sDescrip": "Normal" },
    { "nTipoD": 2, "sDescrip": "Dietético" },
    { "nTipoD": 3, "sDescrip": "Diabético" },
    { "nTipoD": 4, "sDescrip": "Vegano" }
];


//Definir modeo Store Pasteles
Ext.define('ModProductos', {
    extend: 'Ext.data.Model',
    fields: [
        { name: 'clave', type: 'int' },
        { name: 'nombre', type: 'string' },
        { name: 'linea', type: 'string' },
        { name: 'tipo', type: 'string' },
        { name: 'descripcion', type: 'string' },
        { name: 'sabor', type: 'string' },
        { name: 'imagen', type: 'string' },
        { name: 'precio', type: 'float' },
        { name: 'activo', type: 'boolean' }
    ]
});

Ext.onReady(function () {
    let nLinActual = -1;
    let nLinea = 0;
    let nTipo = 0;
    let dlg;

    let arrDatosLinea = Ext.create('Ext.data.Store', {
        fields: ["nLinea", "sDescrip"],
        data: Ext.datos.Linea
    });
    let arrDatosTipo = Ext.create('Ext.data.Store', {
        fields: ["nTipo", "sDescrip"],
        data: Ext.datos.Tipo
    });

    let arrDatosLineaD = Ext.create('Ext.data.Store', {
        fields: ["nLineaD", "sDescrip"],
        data: Ext.datos.LineaD
    });
    let arrDatosTipoD = Ext.create('Ext.data.Store', {
        fields: ["nTipoD", "sDescrip"],
        data: Ext.datos.TipoD
    });

    let datosStore = Ext.create('Ext.data.Store', {
        extend: 'Ext.data.Store',
        store_id: 'elemConsultados',
        model: 'ModProductos',
        autoLoad: true, //se carga al definirse
        autoSync: false,    //se usa cuando tiene elementos asociados
        proxy: {
            type: 'ajax',
            url: 'control/ctrlBuscaProducto.php',
            reader: {
                type: 'json',
                rootProperty: 'data.arrProds'
            }
        }
    });

    let abreDlg = function (btn) {
        let sTipo, sOpe, frmInterna, registro;
        let bCveReadOnly = false, bDatosReadOnly = false;
        if (nLinea == 0 || (nLinActual == -1 && btn.getText() != 'Agregar')) {
            Ext.Msg.alert('Error', "Falta elegir producto");
            return;
        }
        if (nLinActual > -1 && !datosStore.getAt(nLinActual).data.activo) {
            Ext.Msg.alert('Error', "Producto deshabilitado, no modificable");
            return;
        }

        if (nLinea == 1) {
            sTipo = 'Pasteles'
        } else if (nLinea == 2) {
            sTipo = 'Galletas'
        } else if (nLinea == 3) {
            sTipo = 'Gelatinas'
        } else {
            sTipo = 'Panquesitos'
        }

        switch (btn.getText()) {
            case 'Agregar': sOpe = 'a';
                break;
            case 'Modificar': sOpe = 'm';
                break;
            default: sOpe = 'b';
        }

        if (!dlg) {
            dlg = new Ext.Window({
                animateTarget: btn.el,
                closeAction: 'hide',
                height: '23em',
                width: '50em',
                modal: true, //desactiva el resto de la página
                title: 'Edita ',
                constrain: true, //si se limita a su contenedor o no
                autoScroll: true,
                items: [
                    {
                        xtype: 'form',
                        layout: {
                            type: 'table',
                            columns: '2'
                        },
                        id: 'frmEditaPlanta',
                        url: 'control/ctrlGestionarProducto.php',
                        standardSubmit: false,
                        defaultType: 'textfield',
                        items: [
                            {
                                xtype: 'hiddenfield',
                                name: 'txtOpe',
                                value: sOpe
                            },
                            {
                                xtype: 'hiddenfield',
                                name: 'cmbLinea',
                                value: nLinea
                            },
                            {
                                xtype: 'numberfield',
                                fieldLabel: 'Clave',
                                name: 'txtCve',
                                readOnly: true
                            },
                            {
                                fieldLabel: 'Nombre',
                                name: 'txtNom',
                                allowBlank: false
                            },
                            {
                                xtype: 'combobox',
                                fieldLabel: 'Linea',
                                displayField: 'sDescrip',
                                valueField: 'nLineaD',
                                name: 'cmbLineaD',
                                store: arrDatosLineaD,
                                forceSelection: true,
                                emptyText: 'Selecciona',
                                submitEmptyText: false,
                                allowBlank: false
                            },
                            {
                                xtype: 'combobox',
                                fieldLabel: 'Tipo',
                                displayField: 'sDescrip',
                                valueField: 'nTipoD',
                                name: 'cmbTipoD',
                                store: arrDatosTipoD,
                                forceSelection: true,
                                emptyText: 'Selecciona',
                                submitEmptyText: false,
                                allowBlank: false
                            },
                            {
                                fieldLabel: 'Descripción',
                                name: 'txtDescripcion',
                                allowBlank: false
                            },
                            {
                                fieldLabel: 'Sabor',
                                name: 'txtSabor',
                                allowBlank: false
                            },
                            {
                                xtype: 'numberfield',
                                fieldLabel: 'Precio',
                                name: 'txtPrecio',
                                allowBlank: false
                            },
                            {
								xtype: 'filefield',
								fieldLabel: 'Imagen',
								name: 'txtImg',
								accept: 'image',
								buttonText: 'Elegir...'
							}
                        ],
                        buttons: [{
                            text: 'Guardar',
                            handler: function () {
                                var frm = this.up('form').getForm();
                                if (frm.isValid()) {
                                    frm.submit({
                                        success: function (form, action) {
                                            Ext.Msg.alert('Ok', "Registro afectado");
                                            datosStore.load();
                                            dlg.close();
                                        },
                                        failure: function (form, action) {
                                            Ext.Msg.alert('Error',
                                                action.result ? action.result.status : 'Sin respuesta');
                                        }
                                    });
                                }
                            }
                        }]
                    }
                ]
            });
        }
        frmInterna = dlg.down("form").getForm();
        frmInterna.reset();
        frmInterna.findField("txtOpe").setValue(sOpe);
        frmInterna.findField("cmbLinea").setValue(nLinea);
        dlg.setTitle(btn.getText() + ' ' + sTipo);

        frmInterna.findField("cmbLineaD").setStore(arrDatosLineaD);
        frmInterna.findField("cmbTipoD").setStore(arrDatosTipoD);

        if (sOpe === 'a')
            frmInterna.findField("txtCve").setValue(-1);
        else {
            if (btn.getText() == 'Modificar') {
                frmInterna.findField("txtOpe").setValue('m');
                bCveReadOnly = true;
                bDatosReadOnly = false;
            } else {
                frmInterna.findField("txtOpe").setValue('b');
                bCveReadOnly = true;
                bDatosReadOnly = true;
            }
            //En el store vienen todos los atributos, no es necesaria otra lectura
            registro = datosStore.getAt(nLinActual);
            console.log(registro.data);

            //Comvertimos Valores de String a su Numero
            let cmbLineaDl = 0;
            let cmbTipoDl = 0;

            switch (registro.data.linea) {
                case "Pastel":
                    cmbLineaDl = 1
                    break;

                case "Galleta":
                    cmbLineaDl = 2
                    break;

                case "Gelatina":
                    cmbLineaDl = 3
                    break;

                case "Panquesito":
                    cmbLineaDl = 4
                    break;

            }

            switch (registro.data.tipo) {
                case "Normal":
                    cmbTipoDl = 1
                    break;

                case "Dietético":
                    cmbTipoDl = 2
                    break;

                case "Diabético":
                    cmbTipoDl = 3
                    break;

                case "Vegano":
                    cmbTipoDl = 4
                    break;

            }


            frmInterna.findField("txtCve").setValue(registro.data.clave);
            frmInterna.findField("txtNom").setValue(registro.data.nombre);
            frmInterna.findField("cmbLineaD").setValue(cmbLineaDl);
            frmInterna.findField("cmbTipoD").setValue(cmbTipoDl);
            frmInterna.findField("txtDescripcion").setValue(registro.data.descripcion);
            frmInterna.findField("txtSabor").setValue(registro.data.sabor);
            frmInterna.findField("txtPrecio").setValue(registro.data.precio);

            frmInterna.findField("txtCve").setReadOnly(bCveReadOnly);
            frmInterna.findField("txtNom").setReadOnly(bDatosReadOnly);
            frmInterna.findField("cmbLineaD").setReadOnly(bDatosReadOnly);
            frmInterna.findField("cmbTipoD").setReadOnly(bDatosReadOnly);
            frmInterna.findField("txtDescripcion").setReadOnly(bDatosReadOnly);
            frmInterna.findField("txtSabor").setReadOnly(bDatosReadOnly);
            frmInterna.findField("txtPrecio").setReadOnly(bDatosReadOnly);
        }
        dlg.show();
    }

    //Formulario tipo panel
    Ext.create('Ext.form.Panel', {
        title: 'Consulta de Productos',
        renderTo: Ext.get('sct1'),
        scrollable: true,
        bodyPadding: 5,
        collapsible: true,
        width: '100%',
        standardSubmit: false, //LLAMADA PARCIAL
        items: [
            {
                xtype: 'combobox', //lista desplegable
                fieldLabel: 'Linea',
                displayField: 'sDescrip',
                valueField: 'nLinea',
                name: 'cmbLinea',
                store: arrDatosLinea,
                forceSelection: true,
                emptyText: 'Selecciona',
                submitEmptyText: false,
                allowBlank: false,
                listeners: {
                    select: function (combo, record, eOpts) {
                        datosStore.removeAll();
                        nLinActual = -1;
                        nLinea = this.getValue();
                        datosStore.getProxy().url =
                            "control/ctrlBuscaProducto.php?cmbLinea=" + nLinea + "&&cmbTipo=0";
                        datosStore.load();
                    }
                }
            },
            {
                xtype: 'combobox', //lista desplegable
                fieldLabel: 'Tipo',
                displayField: 'sDescrip',
                valueField: 'nTipo',
                name: 'cmbTipo',
                store: arrDatosTipo,
                forceSelection: true,
                emptyText: 'Selecciona',
                submitEmptyText: false,
                allowBlank: false,
                listeners: {
                    select: function (combo, record, eOpts) {
                        datosStore.removeAll();
                        nLinActual = -1;
                        nTipo = this.getValue();
                        datosStore.getProxy().url =
                            "control/ctrlBuscaProducto.php?cmbLinea=" + nLinea + "&&cmbTipo=" + nTipo;
                        datosStore.load();
                    }
                }
            },
            {
                xtype: 'grid',
                store: datosStore,
                collapsible: true,
                columns: [
                    {
                        text: 'Clave',
                        dataIndex: 'clave',
                        width:100,
                        hideable: false
                    },
                    {
                        text: 'Nombre',
                        width:150,
                        dataIndex: 'nombre'
                    },
                    {
                        text: 'Linea',
                        width:100,
                        dataIndex: 'linea'
                    },
                    {
                        text: 'Tipo',
                        width:100,
                        dataIndex: 'tipo'
                    },
                    {
                        text: 'Descripción',
                        width:180,
                        dataIndex: 'descripcion'
                    },
                    {
                        text: 'Sabor',
                        width:100,
                        dataIndex: 'sabor'
                    },
                    {
                        text: 'Imagen',
                        width:220,
                        dataIndex: 'imagen',
                        sortable: false, //permite o no que se reordene la información
                        hideable: false,
                        renderer: function (value) {
                            return '<img src="img/' + value + '">';
                        }
                    },
                    {
                        text: 'Precio',
                        width:100,
                        dataIndex: 'precio'
                    }
                ],
                listeners: {
                    select: function (selModel, record, index, options) {
                        nLinActual = index;
                    },
                    render: function (grid, opts) {
                        if (sessionStorage.getItem('nombreFirmado') === "") {
                            grid.columns[7].hide();
                            Ext.ComponentQuery.query('toolbar', grid)[0].hide();
                        }
                        else {
                            grid.columns[7].show();
                            if (sessionStorage.getItem('tipoFirmado') === "Administrador")
                                Ext.ComponentQuery.query('toolbar', grid)[0].show();
                            else
                                Ext.ComponentQuery.query('toolbar', grid)[0].hide();
                        }
                    }
                },
                buttons: [
                    {
                        text: "Agregar",
                        handler: abreDlg
                    },
                    {
                        text: "Modificar",
                        handler: abreDlg
                    },
                    {
                        text: "Eliminar",
                        handler: abreDlg
                    }
                ]
            }
        ]
    });
});
