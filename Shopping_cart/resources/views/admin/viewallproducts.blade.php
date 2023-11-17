@extends('layouts.adminapp')

@section('admin')
<!-- Begin Page Content -->

<div class="container-fluid">


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
                    Add Product
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody  id="showprod">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="product_form" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <label for="price" class="form-label">Product Price</label>
                                <input type="num" class="form-control" name="price" id="price">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <label for="category" class="form-label">Product Category</label>
                                <input type="text" class="form-control" name="category" id="category">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <label for="description" class="form-label">Product Description</label>
                                <input type="text" class="form-control" name="description" id="description">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <label for="gallery" class="form-label">Product Image</label>
                                <input type="file" class="form-control" name="gallery" id="gallery">

                                <img id="product_image" src="#" width="100px" height="100px" alt="your image" />
                                <input type="hidden" name="image" id="image">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <button type="button" onclick="SaveFile()" id="uploaded_image" class="btn btn-success">Upload Image</button>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="submit" id="saveproduct" class="btn btn-primary" value="saveproduct">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $("#product_form").validate({
            rules: {
                name: "required",
                price: "required",
                category: "required",
                description: "required",
            },

            messages: {
                name: "Please enter Product name.",
                price: "Please enter product price.",
                category: "Please enter product category.",
                description: "Please enter product description."

            }
        })
    })
    $('#product_form').on('submit', function(e) {
        e.preventDefault();
        var result = {};
        $.each($('#product_form').serializeArray(), function() {
            result[this.name] = this.value;
        });

        // console.log(result);
        fetch(`http://localhost:8000/api/admin/product`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: "POST",
            body: JSON.stringify(result)
        }).then((res) => res.json()).then((Response) => {
            fetchdata();
            // console.log(Response);

        })
    });

    let imgInp = document.getElementById("gallery")
    let blah = document.getElementById("product_image")

    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }

    function SaveFile() {
        const form_data = new FormData();
        form_data.append('gallery', $("#gallery")[0].files[0]);
        // console.log($("#gallery")[0].files[0]);
        fetch("http://localhost:8000/api/admin/uploadimage", {
            headers: {
                // 'Accept': 'application/json',
                // 'Content-Type': 'application/json'
                _token: "{{ csrf_token() }}"
            },
            method: "POST",
            body: form_data
        }).then(function(response) {
            return response.json();
        }).then(function(responseData) {
            // console.log(responseData);
            document.getElementById('uploaded_image').innerHTML = '<div class="alert alert-success">Image Uploaded Successfully</div> ';
            document.getElementById("image").value = responseData

        });
    }

    async function fetchdata(e) {
        let allprod = await fetch(`http://localhost:8000/api/admin/viewall`)
        let allprodRes = await allprod.json();
        // console.log(allprodRes);
        let product = ""
        let srno = 1
        allprodRes.forEach(element => {
            // console.log(element.title)
            product += `<tr> 
                <td>${srno}</td>
                <td>${element.name}</td>
                <td>${element.price}</td>
                <td>${element.category}</td>
                <td>${element.description}</td>
                
                <td>
                <img src="/uploads/${element.gallery}" width="50px" alt=""></td>
                <td>
                <button onclick="statusbyid(${element.status})" class="btn btn-primary btn-sm">Active</button>
              
                </td>
                <td>
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal" onclick="editproduct(${element.id})">
                Edit
                </button>
               
                
                <button onclick="deleteproduct(${element.id})" class="btn btn-danger btn-sm">Delete</button>
                </td>
                
                </tr>`
            srno++

        });

        document.getElementById("showprod").innerHTML = product
    }
    fetchdata()
</script>
@endsection