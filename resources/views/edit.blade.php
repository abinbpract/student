<a href="{{route('students.index')}}">back</a>
<form action="{{route('students.update',$student->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    name: <input type="text" name="name" id="name" value="{{$student->name}}">
    @error('name')
    <div>{{$message}}</div>
    @enderror<br>
    email: <input type="text" name="email" id="email" value="{{$student->email}}">
    @error('email')
    <div>{{$message}}</div>
    @enderror<br>

    gender:
    <select name="gender" id="gender">
    <option value="male" @if($student->gender=='male') selected @endif > male </option>
    <option value="female" @if($student->gender=='female') selected @endif > female </option>
  </select>

    @error('gender')
    <div>{{$message}}</div>
    @enderror<br>
        
    age: <input type="text" name="age" id="age" value="{{$student->age}}">
    @error('age')
    <div>{{$message}}</div>
    @enderror<br>
    active: 
    <input type="radio" name="status" id="status" value="1" @if($student->status==1) checked @endif> <label for="">yes</label>
    <input type="radio" name="status" id="status" value="0" @if($student->status==0) checked @endif> <label for="">no</label>
    <br>

    dob: <input type="date" name="date_of_birth" id="date_of_birth" value="{{$student->date_of_birth}}">
    @error('dob')
    <div>{{$message}}</div>
    @enderror<br>
    photo: <img src="{{ url('storage/images/'.$student->image) }}" width="50" height="50" alt="image">
    <input type="file" name="image_file" id="image_file"><br>
    place: <input type="text" name="place" id="place" value="{{$student->address()->value('place')}}">
    @error('place')
    <div>{{$message}}</div>
    @enderror<br>
    pincode: <input type="text" name="pincode" id="pincode" value="{{$student->address()->value('pincode')}}">
    @error('pincode')
    <div>{{$message}}</div>
    @enderror
    <table>
    <tr>
        <th>subject</th>
        <th>mark</th>
    </tr>
    @foreach($student->marks as $subject)
    <tr>
        <td> <input type="text" name="subject[]" id="subject" value="{{$subject->subject}}"></td>
        <td> <input type="text" name="mark[]" id="mark" value="{{$subject->mark}}"></td><br>
    </tr>
    @endforeach
    </table>
    hobbies:
    @foreach($hobbies as $hobby)
    <tr>
        <input type="checkbox" name="hobbie[]" id="hobbie" value="{{$hobby->id}}" @if(in_array($hobby->id,$student->hobbies()->pluck('hobbies.id')->toArray())) checked=checked @endif >
        <td>{{$hobby->name}}</td>
    </tr>
    @endforeach
    <div>
        <button type="submit">Submit</button>
    </div>

</form>