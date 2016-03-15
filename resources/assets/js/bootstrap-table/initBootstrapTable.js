// TODO mejor implementacion.
var initBootstrapTable = function (url, trashedUrl) {
    $().bootstrapTable.showUrlBase = url;
    $().bootstrapTable.showTrashedUrlBase = trashedUrl;
    return url;
};

// del url generado por el backend se cambia el recurso (no-data)
// al correcto, segun el seleccionado
$().bootstrapTable.transformUrl = function (resource, type) {
    if (type === undefined) {
        this.showUrl = this.showUrlBase.replace('no-data', resource);
    }

    if (type == 'trashed') {
        this.showUrl = this.showTrashedUrlBase.replace('no-data', resource);
    }

    return this.showUrl;
};

// http://wenzhixin.net.cn/p/bootstrap-table/docs/examples.html#table-events
function operateFormatter(value, row, index) {

    // el url con la direccion correcta para laravel
    var url;

    // si no existe estatus porque el recurso
    // no tiene softdeletes
    if (row.status === undefined) {
        row.status = ''; // string porque status contiene un date
    }

    // si el length mayor a 0, el usuario esta desactivado
    // porque status contiene nulo cuando no esta desactivado
    if (row.status.trim().length > 0) {
        url = $().bootstrapTable.transformUrl(row.resource.trim(), 'trashed');
    }
    else {
        url = $().bootstrapTable.transformUrl(row.resource.trim());
    }

    return [
        '<a class="table-show" href="' + url + '" title="Consultar">',
        '<i class="fa fa-eye"></i>',
        '</a>'
    ].join('');
}