let ManageTable = function(options = {}) {
    let Main = this;
    this.searchBtn = $('#search-in-table');
    this.formSearchBtn = this.searchBtn.parents('form');
    this.pagination = $('.pagination', this);
    this.columns = $('thead tr th', this);
    this.raws = $('tbody tr', this);
    this.searchSortingBy = this.columns.filter('.search-sorting');
    this.elmHaveSortType = this.searchSortingBy.filter('th[data-sort-type!=""]');
    this.activeElmSorting = this.searchSortingBy.filter('active-sorting');
    this.tbody = $('tbody', this);
    this.pageNumber = $('li.active', this.pagination).children().html();
    this.pageNumbersCount = this.pagination.children('li').length;
    this.currentPath = location.origin + location.pathname + '/';
    this.options = {
        columnName: 'id',
        sortType: 'ASC',
        searchPath: this.currentPath + 'search_in_table',
        sortIcon: 'fa fa-sort',
        sortUpIcon: 'fa fa-sort-up',
        sortDownIcon: 'fa fa-sort-down',
        dataToSend: {},
        isPaginationCounter: true,
    };
    this.exportOptions = {
        export: false,
        type: "xls",
        exportBtn: $('.manage-table-export-btn'),
        filterLastRawColumn: true,
        filterColumns: {},
    };

    this.start = function() {
        this.appendSortableColumns().checkSortElm().refresh();
        return this;
    };
    this.setOptions = function() {
        this.options = $.extend(true, this.options, options);
        return this;
    };
    this.checkSortElm = function() {
        if (this.elmHaveSortType.length) {
            this.activeElmSorting = this.elmHaveSortType.eq(0);
            this.options.sortType = this.elmHaveSortType.data('sort-type').toUpperCase();
        }
        // this.setOptions();
        this.prepareSortTypeChange().sortTypeChanger();
        return this;
    };
    this.appendSortableColumns = function() {
        this.searchSortingBy.each(function() {
            if (!$(this).hasClass('sort-inserted')) {
                let dataToAppend = ` <i class="sort-icon ${Main.options.sortIcon}" ></i>
                                        <i class="sort-type-icon d-none"></i>`;
                $(this).html($(this).html() + dataToAppend);
                $(this).addClass('sort-inserted')
            }
        });
        return this;
    };

    this.searchSortingBy.on('click', function(e) {
        Main.activeElmSorting = $(this);
        Main.options.columnName = $(this).data('sort-name');
        Main.options.sortType = $(this).data('sort-type') ? $(this).data('sort-type') : Main.options.sortType;
        Main.pageNumber = 1;
        Main.toggleSortType();
        Main.refresh();
    });
    this.getColspan = function() {
        $('.get-colspan-numbers').each(function(e) {
            let parentTable = $(this).parents('table'),
                tableThLength = parentTable.find('thead tr').children('th').length;
            $(this).attr('colspan', tableThLength);
        });
    };
    this.setAdditionData = function() {

    };
    this.setDataToSend = function() {

        this.options.dataToSend = {
            'search_value': this.searchBtn.val(),
            'column_name': this.options.columnName,
            'sort_type': this.options.sortType,
            'page': this.pageNumber
        };
        return this;
    };
    this.submitSearch = function() {
        // console.log(this);
        $.get({
            url: this.options.searchPath,
            data: this.options.dataToSend,
            success: function(data) {
                Main.tbody.html('');
                Main.tbody.html(data);
                Main.getColspan();
                Main.pageNumbersCount = $('.pagination').children('li').length;
            }
        })
    };
    this.toggleSortType = function() {
        this.prepareSortTypeChange();

        if (this.options.sortType === 'ASC') {
            return this.sortDesc();
        }

        return this.sortAsc();
    };
    this.prepareSortTypeChange = function() {
        $('.sort-type-icon', this.searchSortingBy).addClass('d-none');
        $('.sort-icon', this.searchSortingBy).removeClass('d-none');
        this.activeElmSorting.children('.sort-type-icon').removeClass('d-none');
        this.activeElmSorting.children('.sort-icon').addClass('d-none');
        return this;
    };
    this.sortTypeChanger = function() {
        if (this.options.sortType === 'ASC') {
            return this.sortAsc();
        }
        return this.sortDesc();
    };
    this.sortAsc = function() {
        this.activeElmSorting.data('sort-type', 'ASC');
        this.activeElmSorting.children('.sort-type-icon').removeClass(this.options.sortDownIcon).addClass(this.options.sortUpIcon);
        this.options.sortType = this.activeElmSorting.data('sort-type');
        return this;
    };
    this.sortDesc = function() {
        this.activeElmSorting.data('sort-type', 'DESC');
        this.activeElmSorting.children('.sort-type-icon').removeClass(this.options.sortUpIcon).addClass(this.options.sortDownIcon);
        this.options.sortType = this.activeElmSorting.data('sort-type');
        return this;
    };
    $('body').on('click', '.pagination .page-link', function(e) {
        e.preventDefault();
        if ($(this).attr('rel')) {
            if (!Main.options.isPaginationCounter) {
                let indexNumber = $(this).attr('href').lastIndexOf('page=');
                Main.pageNumber = parseInt($(this).attr('href').substring(indexNumber + 5));
                return Main.refresh();
            }
            Main.pageNumber = $(this).attr('rel') === 'next' ?
                (parseInt(Main.pageNumber) + 1 <= (Main.pageNumbersCount - 2) ? parseInt(Main.pageNumber) + 1 : Main.pageNumber) :
                parseInt(Main.pageNumber) - 1;

            $(this).parent('li').addClass('active');
            $('.pagination li').removeClass('active');

            return Main.refresh();
        }
        Main.pageNumber = $(this).html();
        $(this).parent('li').addClass('active');
        $('.pagination li').removeClass('active');
        Main.refresh();
    });
    this.searchBtn.on('keyup', function() {
        if (!$(this).val()) {
            Main.refresh();
        }
    });
    this.refresh = function() {
        this.setDataToSend().setOptions().submitSearch();
    };
    this.formSearchBtn.on('submit', function(e) {
        e.preventDefault();
        Main.refresh();
    });
    this.exportOptions.exportBtn.on('click', function() {
        if (Main.exportOptions.export) {
            Main.filterColumns();
            if ($(this).data('export-type')) {
                Main.eq(0).tableExport({
                    type: $(this).data('export-type'),
                });
                return this;
            }
            Main.eq(0).tableExport({
                type: Main.exportOptions.type,
            });
        }
        return this;
    });
    this.filterColumns = function() {
        if (this.exportOptions.filterLastRawColumn) {
            this.filterLastRawColumn()
        }
        $.each(this.exportOptions.filterColumns, function(k, v) {
            v.dataset.tableexportDisplay = 'none';
        });
        return this;
    };

    this.filterLastRawColumn = function() {
        let lastRawAndColumn = $.merge(this.raws.find('td:last-child'), this.columns.last());
        this.exportOptions.filterColumns = {
            ...this.exportOptions.filterColumns,
            ...lastRawAndColumn
        };
        return this;
    };

    return this;
};
$.fn.manageTable = ManageTable;

// ManageTable.$ = $;

$.fn.ManageTable = function(options) {
    return $(this).manageTable(options).start()
};
$(document).ready(function() {
    if ($('#search-table').length) {
        console.log(1);
        $('#search-table').ManageTable();
    }
});

function getColspan() {
    $('.get-colspan-numbers').each(function(e) {
        let parentTable = $(this).parents('table'),
            tableThLength = parentTable.find('thead tr').children('th').length;
        $(this).attr('colspan', tableThLength);
    });
}