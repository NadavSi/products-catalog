$(document).ready(function() {

    //gets params from server json response
    var data = JSON.parse(obj).data;
    var searchStr = JSON.parse(obj).searchStr;
    var criteria = JSON.parse(obj).criteria;

    //sets same query that was erased due to rendering
    $('#searchString').val(searchStr);
    $.each(criteria,function(i,v) {
        $('input[value="' + v + '"]').attr('checked',true);
    });

    //setup for datatables view
    var table = $('#products').DataTable( {
        "processing": true,
        pageLength: 10,
        dom: 'lptri',
        order: [[0, "asc"]],
        pagingType: "full_numbers",
        aLengthMenu: [10, 25, 50, 100],

        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "color" }
        ],
        "columnDefs": [
            {
                targets :[0,2],
                width: '5%',                
            },
            {
                targets:[0],
                sClass: "centertd",
            },
            {
                targets: [1],
                render: function (data, type, full) { 
                    posStart = data.toLowerCase().indexOf(searchStr.toLowerCase()); //get position of search string in name column
                    if (searchStr == '' || $.inArray('name',criteria) == -1 || posStart == -1) { //search is empty or name criteria not selected or search string not in name column
                        markedName = data;
                    }else{                        
                        posEnd = posStart + searchStr.length;
                        markedName = [data.slice(0, posEnd), "</mark>", data.slice(posEnd)].join('');
                        markedName = [markedName.slice(0, posStart), "<mark>", markedName.slice(posStart)].join('');  
                    }

                    return markedName;
                }
            },
            {
                targets: [2],
                render: function (data, type, full) { 
                    posStart = data.toLowerCase().indexOf(searchStr.toLowerCase()); //get position of search string in color column
                    if (searchStr == '' || $.inArray('color',criteria) == -1 || posStart == -1) { //search is empty or color criteria not selected or search string not in color column
                        markedName = data;
                    }else{                        
                        posEnd = posStart + searchStr.length;
                        markedName = [data.slice(0, posEnd), "</mark>", data.slice(posEnd)].join('');
                        markedName = [markedName.slice(0, posStart), "<mark>", markedName.slice(posStart)].join('');  
                    }

                    return markedName;
                }
            }
        ]
    } );
    table.rows.add(data).draw();

    $('#reset').click(function() {
        window.location.href = "/prodcutsCatalog/";
    });

    $('form').submit(function() {
        if($('input[name="cri[]"]:checked').length < 1) {
            alert('select at least one search cirteria');
            return false;
        }
        if(!(/^[a-zA-Z0-9\-\*]*$/.test($('#searchString').val()))) {
            alert("search string not valid");
            return false
        };
    });
} );