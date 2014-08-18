function reload() {
    var sort_field  = $('#sort_field').val();
    var sort_type = $('#sort_type')
    
    ajax{
        url: 'sort_list',
        type: 'post',
        data: {'sort_field':sort_field, 'sort_type':sort_type},
        dataType: 'json',
        sucess: function(row) {
            console.log(data);
        }
    }
}