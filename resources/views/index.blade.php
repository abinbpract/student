<form action="" method="GET">
<input type="text" name="name" id="name" placeholder="name" @if(request()->name!="") value="{{request()->name}}" @endif>
<input type="text" name="email" id="email" placeholder="email" @if(request()->email!="") value="{{request()->email}}" @endif>
<label for="">active</label>
<select name="active" id="active">
    <option value="">select</option>
    <option value="yes" @if(request()->active=='yes') selected @endif > yes</option>
    <option value="no" @if(request()->active=='no') selected @endif >no</option>
</select>
<label for="">age</label>
<select name="age_operator" id="age_operator">
    <option value="">select</option>
    <option value="<" @if(request()->age_operator=='<') selected @endif> < </option>
    <option value=">" @if(request()->age_operator=='>') selected @endif> > </option>
    <option value="=" @if(request()->age_operator=='=') selected @endif> = </option>
</select>
<select name="age" id="age">
    <option value="">select</option>
    @for($i=1;$i<=100;$i++)
    <option value="{{$i}}" @if(request()->age=='{{$i}}') selected @endif> {{$i}} </option>
    @endfor
</select>
<input type="radio" name="gender" id="gender" value="male" @if(request()->gender=='male') checked @endif>male
<input type="radio" name="gender" id="gender" value="female" @if(request()->gender=='female') checked @endif>female
<button type="submit">submit</button>
<a href="{{route('students.index')}}">reset</a>
</form>

<div>
    <a href="{{route('students.create')}}">new student</a>
</div>
<div>
    @if($message=Session::get('success'))
    <div><p>{{$message}}</p></div>
    @endif
</div>
<table border="1">
    <tr>
        <th>name</th>
        <th>email</th>
        <th>gender</th>
        <th>age</th>
        <th>active</th>
        <th>dob</th>
        <th>photo</th>
        <th>place</th>
        <th>pincode</th>
        <th>marks</th>
        <th>hobbies</th>
    </tr>
    @foreach($students as $student)
    <tr>
        <td>{{$student->name}}</td>
        <td>{{$student->email}}</td>
        <td>{{$student->gender}}</td>
        <td>{{$student->age}}</td>
        @if($student->status==1)
            <td>yes</td>
            @else
            <td>no</td>
            @endif
        <td>{{\carbon\carbon::parse($student->date_of_birth)->format('d/m/Y')}}</td>
        <td> <img src="{{ url('storage/images/'.$student->image) }}" width="50" height="50" alt="image"></td>
        <td>{{$student->address()->value('place')}}</td>
        <td>{{$student->address()->value('pincode')}}</td>
        <td>
            <table border="1">
                <tr>
                    <th>subject</th>
                    <th>mark</th>
                </tr>
                @foreach($student->marks as $subject)
                <tr>
                    <td>{{$subject->subject}}</td>
                    <td>{{$subject->mark}}</td>
                </tr>
                @endforeach
            </table>
        </td>
        <td>
        <table>
           @foreach($student->hobbies as $hobby)
            <tr>
                <td>
                {{$hobby->name}} 
                </td>
            </tr>
            @endforeach
        </table>  
        </td>
        <td> <a href="{{route('students.edit',$student->id)}}">edit</a></td>
        <form action="{{route('students.destroy',$student->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <td> <button type="submit">delete</button></td>
        </form>
    </tr>
    @endforeach
</table>