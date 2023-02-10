<form action="{{route('students.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    name: <input type="text" name="name" id="name" value="{{old('name')}}">
    @error('name')
    <div>{{$message}}</div>
    @enderror
    <br>
    email: <input type="text" name="email"  id="email" value="{{old('email')}}">
    @error('email')
    <div>{{$message}}</div>
    @enderror<br>
    gender: 
    <select name="gender" id="gender">
    <option value="">select</option>
    <option value="male">male</option>
    <option value="female">female</option>
  </select>
    @error('gender')
    <div>{{$message}}</div>
    @enderror<br>
    age: <input type="number" name="age" id="age" min="10" max="50" value="{{old('age')}}">
    @error('age')
    <div>{{$message}}</div>
    @enderror<br>
    active: 
    <input type="radio" name="status" id="status" value="1"> <label for="">yes</label>
    <input type="radio" name="status" id="status" value="0"> <label for="">no</label>
    @error('status')
    <div>{{$message}}</div>
    @enderror
    <br>
    dob: <input type="date" name="date_of_birth" id="date_of_birth" value="{{old('date_of_birth')}}">
    @error('dob')
    <div>{{$message}}</div>
    @enderror<br>
    image: <input type="file" name="image_file" id="image">
    @error('image_file')
    <div>{{$message}}</div>
    @enderror
    <br>
    place: <input type="text" name="place" id="place" value="{{old('place')}}">
    @error('place')
    <div>{{$message}}</div>
    @enderror<br>
    pincode: <input type="text" name="pincode" id="pincode" value="{{(old('pincode'))}}">
    @error('pincode')
    <div>{{$message}}</div>
    @enderror<br>
    subject1: <input type="text" name="subject[0]" id="subject">
    mark: <input type="text" name="mark[0]" id="mark"><br>
    subject2: <input type="text" name="subject[1]" id="subject">
    mark: <input type="text" name="mark[1]" id="mark"><br>
    subject3: <input type="text" name="subject[2]" id="subject">
    mark: <input type="text" name="mark[2]" id="mark"><br>
    hobbies: 
    <table>
        @foreach($hobbies as $hobby)
            <tr>
                <input type="checkbox" name="hobbie[]" id="hobbie" value="{{$hobby->id}}">
                <label for="">{{$hobby->name}}</label>
            </tr>
        @endforeach
    </table>
    <div>
        <button type="submit">submit</button>
    </div>
</form>