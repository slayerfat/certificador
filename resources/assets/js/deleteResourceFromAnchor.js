function deleteResourceFromAnchor(id) {
    if (!id) {
        throw new Error('error, no id.');
    }

    if (confirm('Esta acción no se puede deshacer.')) {
        document.getElementById(id).submit();
        return true;
    }
}