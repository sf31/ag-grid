var columnDefs = [
    { field: "country", width: 150, chartDataType: 'category' },
    { field: "group", chartDataType: 'category' },
    { field: "gold", chartDataType: 'series', editable: true, valueParser: numberValueParser },
    { field: "silver", chartDataType: 'series', editable: true, valueParser: numberValueParser },
    { field: "bronze", chartDataType: 'series', editable: true, valueParser: numberValueParser },
    { field: 'a', chartDataType: 'series', editable: true, valueParser: numberValueParser },
    { field: 'b', chartDataType: 'series', editable: true, valueParser: numberValueParser },
    { field: 'c', chartDataType: 'series', editable: true, valueParser: numberValueParser },
    { field: 'd', chartDataType: 'series', editable: true, valueParser: numberValueParser }
];

function createRowData() {
    var countries = ["Ireland", "Spain", "United Kingdom", "France", "Germany", "Luxembourg", "Sweden",
        "Norway", "Italy", "Greece", "Iceland", "Portugal", "Malta", "Brazil", "Argentina",
        "Colombia", "Peru", "Venezuela", "Uruguay", "Belgium"];

    return countries.map(function(country, index) {
        var group = index % 2 == 0 ? 'Group A' : 'Group B';

        return {
            country: country,
            group: group,
            gold: Math.floor(((index + 1 / 7) * 333) % 100),
            silver: Math.floor(((index + 1 / 3) * 555) % 100),
            bronze: Math.floor(((index + 1 / 7.3) * 777) % 100),
            a: Math.floor(Math.random() * 1000),
            b: Math.floor(Math.random() * 1000),
            c: Math.floor(Math.random() * 1000),
            d: Math.floor(Math.random() * 1000)
        };
    });
}

function numberValueParser(params) {
    var res = Number.parseInt(params.newValue);
    if (isNaN(res)) {
        return undefined;
    } else {
        return res;
    }
}

var gridOptions = {
    defaultColDef: {
        width: 100,
        resizable: true,
        sortable: true,
        editable: true
    },
    rowData: createRowData(),
    columnDefs: columnDefs,
    enableRangeSelection: true,
    enableCharts: true,
    // needed for the menus in the carts, otherwise popups appear over grid
    popupParent: document.body,
    onFirstDataRendered: onFirstDataRendered,
    getChartToolbarItems: getChartToolbarItems
};

function getChartToolbarItems(params) {
    return [];
}

function onFirstDataRendered(event) {
    var eContainer1 = document.querySelector('#chart1');
    var params1 = {
        cellRange: {
            rowStartIndex: 0,
            rowEndIndex: 4,
            columns: ['country', 'gold', 'silver']
        },
        chartType: 'groupedBar',
        chartContainer: eContainer1,
        processChartOptions: function(params) {
            params.options.seriesDefaults.tooltip.renderer = function(params) {
                var titleStyle = params.color ? ' style="color: white; background-color:' + params.color + '"' : '';
                var title = params.title ? '<div class="title"' + titleStyle + '>' + params.title + '</div>' : '';
                var value = params.datum[params.yKey].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                return title + '<div class="content" style="text-align: center">' + value + '</div>';
            };

            return params.options;
        }
    };

    event.api.createRangeChart(params1);

    var eContainer2 = document.querySelector('#chart2');
    var params2 = {
        cellRange: {
            columns: ['group', 'gold']
        },
        chartType: 'pie',
        chartContainer: eContainer2,
        aggFunc: 'sum',
        processChartOptions: function(params) {
            params.options.legend.position = 'bottom';
            params.options.padding = { top: 20, left: 10, bottom: 30, right: 10 };

            params.options.seriesDefaults.tooltip.renderer = function(params) {
                var titleStyle = params.color ? ' style="color: white; background-color:' + params.color + '"' : '';
                var title = params.title ? '<div class="title"' + titleStyle + '>' + params.title + '</div>' : '';
                var value = params.datum[params.angleKey].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                return title + '<div class="content" style="text-align: center">' + value + '</div>';
            };

            return params.options;
        }
    };

    event.api.createRangeChart(params2);

    var eContainer3 = document.querySelector('#chart3');
    var params3 = {
        cellRange: {
            columns: ['group', 'silver']
        },
        chartType: 'pie',
        chartContainer: eContainer3,
        aggFunc: 'sum',
        processChartOptions: function(params) {
            params.options.legend.position = 'bottom';
            params.options.padding = { top: 20, left: 10, bottom: 30, right: 10 };

            params.options.seriesDefaults.tooltipRenderer = function(params) {
                var titleStyle = params.color ? ' style="color: white; background-color:' + params.color + '"' : '';
                var title = params.title ? '<div class="title"' + titleStyle + '>' + params.title + '</div>' : '';
                var value = params.datum[params.angleKey].toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
                return title + '<div class="content" style="text-align: center">' + value + '</div>';
            };

            return params.options;
        }
    };

    event.api.createRangeChart(params3);
}

// setup the grid after the page has finished loading
document.addEventListener('DOMContentLoaded', function() {
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
});
