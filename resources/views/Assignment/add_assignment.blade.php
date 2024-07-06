@extends('mainPage')

@section('maincontent')
    {{-- our links --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <center>
        <form id="fTable" method="post" action="#" enctype="multipart/form-data">
            <div class="card">

                <div class="card-header mt-2">
                    <p style="font-weight:bold;font-size:18px;color:black">ADD ASSIGNMENTS<br></p>
                </div>
                <style>
                    .add_new,
                    .delete:hover {
                        cursor: pointer;

                    }

                    .add_new,
                    .delete {
                        font-size: 35px;

                    }

                    .add_new {
                        color: #28A745;
                    }

                    .delete {
                        color: #DC3545;
                    }

                    .hc {
                        display: none;
                    }
                </style>
                <div class="card-body " style="font-size:13px">
                    <table class="table table-bordered mt-3">
                        <thead class="table-dark">
                            <tr style='text-transform: uppercase; text-align:center;'>
                                <th rowspan='2'>Sl No</th>
                                <th rowspan='2'>Academic Year</th>
                                <th rowspan='2'>Task Name</th>
                                <th rowspan='2'>Description</th>
                                <th colspan='2'>Deadline</th>
                                <th rowspan='2'>Upload Document</th>
                                <th rowspan='2'>Add/Delete</th>
                            </tr>
                            <tr style='text-align:center;'>
                                <th>From</th>
                                <th>To</th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr style='text-align:center;'>
                                <td><span class="sl" style="font-size:18px;">1</span></td>

                                <td>
                                    <select class='form-control' name='acd_year[]' id='acd_year' required>
                                        <option value=''>select academic year</option>
                                        <option>2019-2020</option>
                                        <option>2020-2021</option>
                                        <option>2021-2022</option>
                                        <option>2022-2023</option>
                                        <option>2023-2024</option>
                                    </select>
                                </td>
                                <td>
                                    <input type='text' id='task' name='task[]' class='form-control'
                                        placeholder='Enter Task Name' required>
                                </td>

                                <td>
                                    <textarea id='description' name='description[]' class='form-control' placeholder='Enter Description' required></textarea>
                                </td>

                                <td>
                                    <input type='date' id='from' name='from[]' class='form-control from-date'
                                        placeholder='Enter From Date' required>
                                </td>

                                <td>
                                    <input type='date' id='to' name='to[]' class='form-control to-date'
                                        placeholder='Enter To Date' required>
                                </td>

                                <td>
                                    <input type='file' id='file' multiple='multiple' name='file[]'
                                        class='form-control' onchange='validateFile(this)' required>
                                </td>
                                <td>
                                    <center>
                                        <i class="bi bi-patch-plus add_new hide" style="font-size: 27px;"></i>
                                        <i class="bi bi-trash3 delete" style="font-size: 27px;"></i>
                                    </center>

                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-success rounded" id="submit1">Submit</button>
                </div>
            </div>

    </center>

    <script>
        $(document).on('click', '.add_new', function() {
            var row = $(this).closest('tr');
            row.find(".hide").hide();
            var sl = parseInt(row.find(".sl").text());
            sl++;
            markup = '<tr>';
            markup += '<td><span class="sl" style="font-size:18px;">' + sl + '</span></td>';
            //Academic Year Field
            markup += "<td><select class='form-control' name='acd_year[]' id='acd_year' required>" +
                "<option value=''>select academic year</option>" +
                "<option>2019-2020</option>" +
                "<option>2020-2021</option>" +
                "<option>2021-2022</option>" +
                "<option>2022-2023</option>" +
                "<option>2023-2024</option>" +
                "</select></td>";
            //Task Name Field
            markup +=
                "<td><input type='text' id='task' name='task[]' class='form-control' placeholder='Enter Task Name' required></td>";
            //Description Field
            markup +=
                "<td><textarea id='description' name='description[]' class='form-control' placeholder='Enter Description' required></textarea></td>";
            //From Date Field
            markup +=
                "<td><input type='date' id='from' name='from[]' class='form-control from-date' placeholder='Enter From Date' required></td>";
            //To Date Field
            markup +=
                "<td><input type='date' id='to' name='to[]' class='form-control to-date' placeholder='Enter To Date' required></td>";
            //File Upload Field
            markup +=
                "<td><input type='file' id='file' name='file[]' class='form-control' onchange='validateFile(this)' required></td>";
            //Add and Delete Icon Field
            markup += "<td>";
            markup += "<center>";
            markup += "<i class='bi bi-patch-plus add_new hide' style='font-size:27px'></i>";
            markup += "<i class='bi bi-trash3 delete' style='font-size:27px'></i></center>";
            markup += "</td>";
            markup += "</tr>";
            tableBody = $("tbody");
            tableBody.append(markup);
            $.fn.picker();
        });

        $(document).on("click", '.delete', function() {
            var rowCount = $('.table >tbody >tr').length;
            var row = $(this).closest('tr');
            var sl = parseInt(row.find(".sl").text());
            if (sl === 1) {
                swal({
                    title: "Cannot delete the First row",
                    icon: "warning",
                });
                return
            }
            row.prev().find(".hide").show();
            $(this).closest('tr').remove();
        });

        //To Date Selection based on From date
        $(document).on('change', '.from-date', function() {
            var fromDate = $(this).val();
            $(this).closest('tr').find('.to-date').attr('min', fromDate);
        });

        //file Upload error handling
        function validateFile(input) {
            const file = input.files[0];
            if (file) {
                const fileType = file.type;
                const fileSize = file.size;
                const allowedType = "application/pdf";
                const maxSize = 200 * 1024; // 200KB

                if (fileType !== allowedType) {
                    swal({
                        title: "Invalid file type",
                        text: "Please upload a PDF file.",
                        icon: "warning",
                    });
                    input.value = "";
                } else if (fileSize > maxSize) {
                    swal({
                        title: "File size exceeded",
                        text: "Please upload a file less than 200KB.",
                        icon: "warning",
                    });
                    input.value = "";
                }
            }
        }
    </script>
@endsection
