@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-12 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> Student List
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Student List</li>
                        </ol>
                    </nav>
                    @include('session-messages')
                    <h6>Filter list by:</h6>
                    <div class="mb-4 mt-4">
                        <form class="row" action="{{route('payment.list.show')}}" method="GET">
                            <div class="col">
                                <select onchange="getSections(this);" class="form-select" aria-label="Class" name="class_id" required>
                                    @isset($school_classes)
                                        <option selected disabled>Please select a class</option>
                                        @foreach ($school_classes as $school_class)
                                            <option value="{{$school_class->id}}" {{($school_class->id == request()->query('class_id'))?'selected="selected"':''}}>{{$school_class->class_name}}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select" id="section-select" aria-label="Section" name="section_id" required>
                                    <option value="{{request()->query('section_id')}}">{{request()->query('section_name')}}</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-arrow-counterclockwise"></i> Load List</button>
                            </div>
                        </form>
                        @foreach ($studentList as $student)
                            @if ($loop->first)
                                <p class="mt-3"><b>Section:</b> {{$student->section->section_name}}</p>
                                @break
                            @endif
                        @endforeach
                        <div class="bg-white   p-5 mt-4">
                         
                            <table class="table table-responsive data-table" id="table">
                                
                                
                                <thead>
                                    <tr>
                                        <th scope="col">ID Card Number</th>
                                        <th scope="col"> Name</th>
                                        <th scope="col">Total Fees</th>
                                        <th scope="col">DUE</th>
                                        <th scope="col">Get Fee</th>
                                    </tr>
                                </thead>
                        <form action="{{route('paymnet.store')}}" method="post" enctype="multipart/form-data">
                         @csrf
                                <tbody>
                                   
                                    @foreach ($studentList as $students)
                                    
                                        <tr class=" item{{$students->student->id}} ">
                                            <th scope="row">{{$students->student->id}} 
                                                <input type="hidden" name="student_roll[]" value="{{$students->student->id}}">
                                            </th>
                                            <td>{{$students->student->last_name}} 
                                                <input type="hidden" name="student_name[]" value="{{$students->student->last_name}}">
                                            </td>
                                             <td>
                                                {{$students->student->fees}}
                                               
                                            </td>
                                             <td>
                                              @php
                                               $due= \App\Models\StudentPayment::where(['student_roll'=>$students->student->id])->pluck('due')->last() ; 
                                                
                                              @endphp
                                                 <input type="hidden" name="total_fee[]" value="{{ isset($due)?$due:$students->student->fees}}">
                                                
                                                    {{$due }}
                                                   
                                            
                                              
                                            </td>
                                            
                                            <td>
                                                    <input type="number" class="" name="ammount[]" placeholder="pay Your Ammout" maxlength = "">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <button type="submit"  class="btn btn-sm btn-primary"> Pay</button>
                            </form>
                            </table>
                           
                        
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
<script>
    function getSections(obj) {
        var class_id = obj.options[obj.selectedIndex].value;

        var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id 

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {
            var sectionSelect = document.getElementById('section-select');
            sectionSelect.options.length = 0;
            data.sections.unshift({'id': 0,'section_name': 'Please select a section'})
            data.sections.forEach(function(section, key) {
                sectionSelect[key] = new Option(section.section_name, section.id);
            });
        })
        .catch(function(error) {
            console.log(error);
        });
    }
</script>
<script>
    $(document).ready(function() {
      $('#table').DataTable();
  } );
   </script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script type="text/javascript">
    $(".download-pdf").click(function(){

        var data = '';
        $.ajax({
            type: 'GET',
            url: '/pdf/generate',
            data: data,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response){
                var blob = new Blob([response]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "Sample.pdf";
                link.click();
            },
            error: function(blob){
                console.log(blob);
            }
        });
    });

</script>

@endsection
