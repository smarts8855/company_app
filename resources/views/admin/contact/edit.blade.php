@extends('admin.admin_master')
@section('admin')

<div class="col-lg-10">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create Contact</h2>
        </div>
        <div class="card-body">
               <form action="{{ url('update/contact/'.$contacts->id) }}" method="POST" >
                         @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email</label>
                    <input type="email" name="email" class="form-control" value="{{  $contacts->email }}">
                    
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{  $contacts->phone }}">
                    
                </div>           
               
                
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Address</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="address">
                        {{  $contacts->address }}
                    </textarea>
                </div>
                
                
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    
                </div>
            </form>
        </div>
    </div>    
</div>
@endsection