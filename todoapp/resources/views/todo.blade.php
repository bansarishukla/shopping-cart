@extends('app')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Create Todo</h1>
                </div>
                <form action="{{ url('todo') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="control-label">Todo</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">List Todo</h1>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todos as $todo)
                            <tr>
                                <td>{{ $todo->name }}</td>
                                <td>
                                    <form action="{{ url('/todo/'. $todo->id) }}" method="post">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <butoon type="submit" class="btn btn-danger">Delete</butoon>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
