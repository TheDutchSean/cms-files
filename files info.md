Files acces mode
Read                                Read and Write
- r: Read from start                r+
- w: Truncate/write from start      w+
- a: Append/write from end          a+

Whene to use what mode
Use w whene starting a brand new file, on a existing file this will clear all exsiting data.
Use r+ to read and write to an existing file
Use r to read the contents of a file
Use a to append data to the end of an existing file


Use fread to get parts of an file

Use file_get_contents on files that are not to big and if you want to get the complete file.

the user premissions in unix consits of rwx and are set in pairs 3. user, group and other. If you replace the a charachter by a dash/- the premission is set to non

Example
rwx rwx ---
 
Result
user:   read=y, write=y, execute=y
group:  read=y, write=y, execute=y
other:  read=n, write=n, exectue=n

cli commands
sudo chmod ugo=rwx file.txt
sudo    =   sets privlage,
chmod   =   change mode,
ugo     =   User, Group, Other

This sets the premission to read, write and exectue to all on the file.txt

By leaving out a value you dont set premissions for the eft out value

sudo chmod u=r file.txt

Will only set read right for the user

In windows cmd
https://ss64.com/nt/icacls.html#:~:text=Related%20commands&text=DIR%20%2FQ%20%2D%20Display%20the%20owner,Show%20permissions%20for%20a%20user.

icacls folder/file name

https://www.cygwin.com/


To add a line return in Unix or macOS:
Line one\nLine two

Windows
Line one\r\nLine two


in general you want only users to be able to upload files this due to abuse of uploading files

validate file type and file extensions, only allow the exspected file tpes

limit the maximum upload size