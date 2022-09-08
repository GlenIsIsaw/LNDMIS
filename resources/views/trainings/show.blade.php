<h1>{{$training->certificate_title}}</h1>

<label for="name">Name</label>
<h4>{{$training->name}}</h4>
<label for="certificate_title">Training</label>
<h4>{{$training->certificate_title}}</h4>
<label for="level">Level</label>
<h4>{{$training->level}}</h4>
<label for="date">Date Covered</label>
<h4>{{$training->date_covered}}</h4>
<label for="hours">Number of Hours</label>
<h4>{{$training->num_hours}}</h4>
<label for="certificate">Certificate</label>
<img src="{{ url('storage/users/'.$training->name.'/'.$training->certificate) }}"
style="height: 100px; width: 150px;">



