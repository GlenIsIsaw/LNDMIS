<form action="{{route('document.store')}}" enctype="multipart/form-data" method="POST">
    @csrf
    <label for="name">Parent's Name:</label><br>
    <input type="text" id="pname" name="pname"><br>
    <label for="name">Parent's Age:</label><br>
    <input type="text" id="page" name="page"><br>
    <label for="name">Stundent's Name:</label><br>
    <input type="text" id="sname" name="sname"><br>
    <label for="name">Student's Age:</label><br>
    <input type="text" id="sage" name="sage"><br>
    <label for="name">Section:</label><br>
    <input type="text" id="section" name="section"><br>
    <label for="name">Relation:</label><br>
    <input type="text" id="relation" name="relation"><br>
    <label for="name">Date Day:</label><br>
    <input type="text" id="dated" name="dated"><br>
    <label for="name">Date Month:</label><br>
    <input type="text" id="datem" name="datem"><br>
    <label for="name">Parent's NUmber:</label><br>
    <input type="text" id="pnum" name="pnum"><br>
    <label for="name">Parent's Email:</label><br>
    <input type="text" id="pemail" name="pemail"><br>
    <label for="name">Student's Number:</label><br>
    <input type="text" id="snum" name="snum"><br>
    <label for="name">Student's Email:</label><br>
    <input type="text" id="semail" name="semail"><br>

    <label for="photo">Attach a photo of the Signature:</label><br>
    <input type="file" name="photo" accept="image/*" id="photo" required>
    <input type="submit" value="Submit Input">
</form>