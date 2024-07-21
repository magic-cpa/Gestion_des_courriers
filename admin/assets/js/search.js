document.getElementById('searchInput').addEventListener('keyup', function() {
    var searchValue = this.value.toLowerCase();
    var tableBody = document.getElementById('courrierTableBody');
    var rows = tableBody.getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName('td');
        var rowContainsSearchTerm = false;

        for (var j = 0; j < cells.length; j++) {
            if (cells[j].textContent.toLowerCase().includes(searchValue)) {
                rowContainsSearchTerm = true;
                break;
            }
        }

        if (rowContainsSearchTerm) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
});