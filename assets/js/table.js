new Vue({
    el: '#table',
    components: {
        'BootstrapTable': BootstrapTable
    },
    data: {
        columns: [
            {
                title: 'Item ID',
                field: 'id'
            },
            {
                field: 'name',
                title: 'Item Name'
            }, {
                field: 'price',
                title: 'Item Price'
            }
        ],
        data: [
            {
                id: 1,
                name: 'Item 1',
                price: '$1'
            }
        ],
        options: {
            search: true,
            showColumns: true
        }
    }
})