<html>

<head>
    <title>Upload File Using PHP</title>
    <style>
        body {
            font-family: cambria;
        }
    </style>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data" id="frm">
        <h2>Upload File Using PHP</h2>
        <label for="fselect">Select File to Upload:</label>&nbsp;&nbsp;
        <input type="file" name="file" id="fselect"><br><br>
        <input type="submit" name="sub" value="Submit">
        <p><b>Note:</b>Only .pdf,.docx formats.</p>
    </form>
    <?php
    if (isset($_POST["sub"])) {
        $allow = array("pdf" => "application/pdf", "docx" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document"); // it checks the format of Pdf with pdf key,the format of docx with docx key
        $name = $_FILES["file"]["name"];// it stores the file name in the form of array
        $type = $_FILES["file"]["type"]; // it stores the file's type name(pdf document,word document) in the form of array
        $ext = pathinfo($name, PATHINFO_EXTENSION); // pathinfo_extension takes only the extension(.pdf,.docx) of a particular file,not the name of the file...In which is stored in $name variable(smaple.php)
    
        if (!array_key_exists($ext, $allow)) // It checks the extension in $ext variable is not  equal to $allow keys(pdf,docx) means...If we upload .jpg,.mp4 file files this condition will works..
            die("Please Select valid File Format");
        if (in_array($type, $allow)) { // It checks the type of file in $type variable is equal to $allow formats(values=>application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingxml.document)means...
            if (file_exists(("Files/" . $name))) { // Files is a folder name ...$name is about file name
                echo "This File is already exists";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], "Files/" . $name);// ["tmp_name"]is a temporary name & it stores the browsed files...and that moves the file to Files Folder
                echo "Your File was Uploaded successfully";
            }
        }
    }
    ?>
</body>

</html>