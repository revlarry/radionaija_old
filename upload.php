<?php
if(isset($_POST))
{
    if(is_uploaded_file($_FILES['mp3']['tmp_name']))
    {
        // File is uploaded correctly
    }
    else
    {
        // File isn't uploaded correctly
    }
}
else
{
    // Nothing posted, show the form
}

// File is uploaded correctly
        if($_FILES['mp3']['type'] == 'audio/mpeg')
        {
            if(!move_uploaded_file($_FILES['mp3']['tmp_name'], '/path/to/your/uploads/dir/' . $_FILES['mp3']['filename']))
            {
                // File was moved successfully!
            }
            else
            {
                // File was not moved successfully
            }
        }
        else
        {
            // File is not of the audio/mpeg type
        }  