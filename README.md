AutoProjectSetup
================
This script will create the relevant folders and libraries for the foundations of any JavaScript project.  

###Libraries Included
* Jasmine Testing  
* ToolkitJS  

##Usage

Simple place the **setup.php** in the root of your project and ensure you are using a local server or any server with php enabled. Then navigate to the setup file.  

###For Example  
http://localhost/myprojectname/setup.php  

This file will create the folders and files. Delete the setup file once the process has completed.  

##Folder Structure
```
deploy  
jasmine  
  -spec  
  -specRunner.html  
lib  
  -fahimchowdhury  
     -toolkitMax-v1014-compressed.js  
  -jasmine-1.3.1  
    -jasmine.css  
    -jasmine.js  
    -jasmine-html.js  
resource  
  -css  
     -style.css  
src  
  -main.js  
index.html  
```


##Auto Deploy
You can use the **'deploy.php'** to deploy all the files and folders from the root of your directory into the deployed folder. It will filter out the folders which are not to be deployed such as 'jasmine', 'deploy' etc...

