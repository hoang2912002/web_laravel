{{--Muốn ôm tất cả course để hiển thị ở bên layout thì mình cần phải kế thừa nó
và dùng hàm extends()  
  @section() để viết nội dung vào thằng ở giữa bên master đã khai báo có tên là "content"
--}}
@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="card">
        @if ($errors->any())
            <div class="card-header">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div> 
        @endif
        
        <div class="card-body">
            <a class="btn btn-success" href="{{route('courses.create')}}">Thêm</a>
            <div class="form-group">
                <select name="" id="select-name">

                </select>
            </div>
            {{-- <form action="" class="float-right form-group form-inline">
                <label class="mr-2" for="">Search: </label>
                <input type="search" name="q" id="" value="{{$search}}" class="form-control">
            </form> --}}
            <table class="table table-centered mb-0" id="table-index">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Create At</th>
                        <td>Edit</td>
                        <th>Delete</th>
                    </tr>
                </thead>      
            </table>
        </div>
    </div> 
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {
            $("#select-name").select2({
                ajax: {
                    url: '{{route("courses.api.name")}}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                    return {
                        q: params.term, // search term
                    };
                    },
                    processResults: function (data, params) {
                        return {
                            results:$.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                            
                        };
                    },
                    //cache: true
                },
                placeholder: 'Search for a name',
                
            });
            
           

            
            
            var buttonCommon = {
                exportOptions: {
                    columns: ':visible :not(.not-export)',
                }
            };
            let table = $('#table-index').DataTable({
                
                dom: 'Blrtip', 
                select: true,
                buttons: [ 
                    $.extend( true, {}, buttonCommon, {
                        extend: 'copyHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'csvHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'excelHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'pdfHtml5'
                    } ),
                    $.extend( true, {}, buttonCommon, {
                        extend: 'print'
                    } ),
                    'colvis'
                ],
                lengthMenu: [ 1, 25, 50, 75, 100 ],
                columnDefs: [ {
                    className: "not-export", targets: 3
                } ],
                processing: true,
                serverSide: true,
                ajax: '{!! route('courses.api') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    //{ data: 'year_created_at', name: 'created_at' },
                    { 
                        data: 'edit',
                        targets: 3,
                        orderable: false,
                        searchable: false, 
                        render: function ( data) {
                            return `<a class="btn btn-primary" href="${data}">Edit</a>`;
                        }
                    },
                    { 
                        data: 'destroy',
                        targets: 4,
                        render: function ( data) {
                            return `<form action="${data}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete btn btn-danger">Delete</button>
                            </form>`;
                        }
                    },
                ]
            });

            $('#select-name').change( function () {
                table.columns( 0 ).search( this.value ).draw();
            } );
            /**
                có nghĩ là cứ trong document mà có xuất hiện click của class ".btn-delete" thì nó sẽ bắt 
                sự kiện
            **/   
            $(document).on('click','.btn-delete',function(){
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    data: form.serialize(),
                    dataType:'json',
                    type:'POST',
                    success: function () {
                        console.log('success');
                        /**draw để mà load lại thằng table **/
                        table.draw();
                    },
                    error: function () {
                        console.log('error');
                    }
                });
                
                
            });
        });
    </script>
@endpush