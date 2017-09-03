# BucsBot
This is for /r/Buccaneers, to help our friends.


Section 1: DOWNLOADS
Please install the following software from the linked locations. Annotated below is the item's purpose:

1- Python 3.5 (https://www.python.org/ftp/python/3.5.0/python-3.5.0-amd64.exe)
-This will handle the connection to reddit for posting the bot data.
2- jEdit (http://sourceforge.net/projects/jedit/files/jedit/5.4.0/jedit5.4.0install.exe/download)
-This is a PHP editor, what will be used to view/modifiy the game data source code.
3- XAMPP (https://www.apachefriends.org/xampp-files/7.1.8/xampp-win32-7.1.8-0-VC14-installer.exe)
-This is what will allow you to use an APACHE server on your localhost, which will allow the CRON job to update the stats from the NFL
4- GNU Wget (https://eternallybored.org/misc/wget/current/wget64.exe)
-This will trigger the PHP reads on interval

##PROCEED TO INSTALLS STEP 1, THEN AFTER COMPLETING, RETURN TO THIS STEP!!!##
5- Get-Pip.py (This one is tricky. Go to this website https://pip.pypa.io/en/stable/installing/, scroll down to "installing with get-pip.py" right click the "securely download get-pip.py" file and save it as a python file and at the directory of "C:\users\<name>\appdata\local\programs\python\python35\scripts"
-This is the feature used to install other modules. 


Section 2: INSTALLS
Please install in this order (do not skip any steps, and follow these procedures)

1- Install Python 3.5. Once installed, verify that you are able to see the install file location as "C:\users\<name>\appdata\local\programs\python\python35". To verify the install worked, see if you have "python.py" in that folder.

2- Return to downloads step five and download get-pip.py. After downloaded to the recommended location, go to that location and double click "get-pip.py". A file should run and it will install Pip to your scripts folder.

3- Now install the modules needed for Python. To do so, open up a command propmt window (Windows Key + R, type "cmd", press enter).
(Python is tricky about installing modules (dunno why, it should be straightforward but it NEVER is) so please follow this exactly.)

a. Once you have command prompt open, type "CD C:\users\<name>\appdata\local\programs\python\python35\". You are now in the Python folder for 3.5. Now in command prompt type "python -m pip install praw" and press enter. This will install the wrapper for the Reddit API.

b. after installing PRAW, type "python -m pip install pdb" and press enter.

c. after installing PDB, type "python -m pip install OS" and press enter. (If this fails, it's because it's redundant in your version and you're fine, don't even sweat it)

4- Install WGET that you downloaded before. Just make sure it saves in it's recommended default locations (which should be the downloads folder)

5- Install jEdit

6- Install XAMPP


THIS IS THE END OF INSTALLING ALL REQUIRED PYTHON SOFTWARE, YOU ARE NOW ABLE TO EDIT THE GAMEDAY BOT AS NEEDED.


Section 3: CONFIGURING BOT
a- Configuring the bot isn't straightforward as of yet because there are multiple steps. The first step is critical. You MUST create a new reddit account for the bot (ours is /u/Keep_Pounding_Bot, you guys feel free to use something Bucs related, such as "/u/OVERRATED_CANNON_DECORATION" or something. Once that account is created, it is RECOMMENDED (not required) to make it a moderator of /r/Buccaneers. We made ours a mod so it would have the green name and look official, but it's not necessary. 

b- After the account is created, you MUST register it with reddit for API access. To do this, log in and go here: https://www.reddit.com/prefs/apps

c- On this site, at the bottom, click "Create another app". Select "Web App". Give it a name (ours is Panthers_Gameday_Bot, I recommend Bucs_Gameday_Bot). You MUST give it a description that the reddit admins can use to source the owner. Ours is "This is an application created by /u/NAS89 to automatically post /r/Panthers Gameday Threads".

d- You MUST provide an "about" URL. (the jury is out if the URL has to be valid....) but this URL should go somewhere to give users an "about" on the bot. Ours goes to http://www.reddit.com/r/panthers/wiki/Keep_Pounding_Bot_About, so if you want, just add a wiki page to your subreddit with the name of your bot and link that.

e- Use http://127.0.0.1:65010/authorize_callback as the "Redirect URI". You're not hosting this on a separate server from the PC you're running it on so don't EVEN sweat it.

Once this is completed, "Create app". You should now be given an app page that looks like this: https://gyazo.com/fb5930456bb11f792e452c131c85d675

Now that you have a reddit bot account, let's configure the bot to make it's first gameday post and put in the required information. Save the file from this repository (GameDayBot.py) to the C:\users\<name>\appdata\local\programs\python\python35\scripts folder. Once saved, right click on it and select "Edit with IDLE 3.5". You should see some fields that require your attention. These are:

1- (client_id='<REDDIT CLIENT ID HERE>' = Replace the <REDDIT CLIENT ID HERE> string with the information from the bot API page (named "web app", should be 14 characters long)
2- client_secret='<CLIENT SECRET HERE>' = Replace the <CLIENT SECRET HERE> string with the secret given from the bot API page.
3- password='<ENTER PASSWORD HERE>',
              user_agent='Created by <PLEASE USE THE MAINTAINER USERNAME HERE>',
              username='<ENTER USERNAME HERE>')  
                                                            = Changing this is all self explanatory. 

4- post = reddit.subreddit('Buccaneers').submit(
                title='Game Thread: <TEAM1> (0-0) AT <TEAM2> (2-1) ',
                selftext = '<ADD AN ALT TEXT HERE, ITS ONLY FOR THE FIRST POST>',
                url=None)
                                                            = This needs to be changed before every game. The information in the title column will be what your post is called. We use the format <AWAY TEAM FULL NAME (record) AT HOME TEAM FULL NAME (record) for our posts. selftext is what the bot posts the first time, this is overwritten almost instantly. My selftext is my favorite song title, your can be whatever fun little thing you want. Leave url alone.
                                                            
AT THIS TIME, the bot is configured and we need to go look at our PHP function to make a little change there.


Save the file GameUpdate.PHP to C:\xampp\htdocs and then go to that file location, right click and select "Open with jEdit". There is VERY LITTLE you need to do here on a weekly basis. All you have to do is change the location of the JSON where we'll pull data from the NFL and change the header of the post itself.

1- JSON and You: A Brief Overview: Clash of Clans
The NFL provides a location each week for it's data scraping. Unfortunately, unless you pay the $10k subscription license, you don't get access to the API so you have to do this the shit way. Luckily, a handsome redditor in California that roots for superior NFC South team already did the heavy lifting. What the PHP function does is it pulls the JSON data from the NFL, decodes it into a usable database of information, and then breaks that further down into subplots. You can read through the code to see how/what, but the four important things are:

a- go to http://www.nfl.com/liveupdate/scorestrip/ss.xml and find the game you want to pull stats from. These are usually available for the upcoming game by Tuesday of each week. For this test, the game you want is "Dolphins vs TB" so look for that and COPY the EID number associated with it (2017091006).

b- return to the PHP, find the OLD EID number (2017083154), and performa a FIND AND REPLACE (Cntrl + F, Replace All) with the NEW EID number (2017091006). You should now see something like $json = file_get_contents('http://www.nfl.com/liveupdate/game-center/2017091006/2017091006_gtd.json'); and $Clock = $obj['2017091006'];. If those changed, you're good. 

e- Navigate to line 72 and modify the header to read what you want. We use special formatting at /r/Panthers to show flair, so if you also use the flair, change yours to show this:

$Header .= '[](/TB)[Tampa Bay Buccaneers](/r/Buccaneers) [at](#at) [](/MIA)[Miami Dolphins](/r/Dolphins)';

If you do NOT use CSS tags for team flair, replace it to say this:

$Header .= '[Tampa Bay Buccaneers](/r/Buccaneers) [at](#at) [Miami Dolphins](/r/Dolphins)';

Finally scroll down to line 605 and replace the file location with your user account name ($file = 'C:\Users\<name>\AppData\Local\Programs\Python\Python35\thisfile.txt';)

What this does is, when the PHP is triggered (we're about to get there), the PHP script does two things:
1- It writes to a text file that the python bot will pull in and post to the subreddit;
2- It echos (displays on a webpage) the OUTPUT file so that you can view it for diagnostics. I've written it to ignore non-major errors, so for instance, if there has yet to be a running play, there is no running statistics, so you'll get an error that it is null, and the table is empty, but it will still post for you.


CONFIGURING THE PHP TO RUN:
Getting the PHP file to run is very simple. Open XAMPP, on the control panel for XAMPP, Click "START" on the Apache server. This will now turn your PC into an apache server and PHP can be ran. To test if it worked, go to "http://localhost/gameupdate.php" on a web browser and you should see a bunch of errors (no game data yet) and also you'll see at the bottom the header information printed. Now navigate to C:\users\<name>\appdata\local\programs\python\python35 and open "thisfile.txt" and you should see the raw file that the bot will post. Congrats, now you're ready to configure Windows to automatically trigger your PHP file!


CONFIGURING WGET TO RUN AUTOMATICALLY:
This is probably the most frustrating thing each week. Since we don't use a server, we don't have access to CRON jobs, so we have to do this ourselves. We'll be creating a scheduled task to check the PHP file every MINUTE and that will cause it to save and update. (The bot posts every 15 seconds, so rarely is there a miss). I have posted the export file for our task, so there is very little change you'll need to make. The first step is to save the file "GameUpdate.XML" to C:\Users\<name>\Downloads\GetGnuWin32\bin.

1- Open "Task Scheduler" (press the start button, then type "task scheduler". Right Click "Task Scheduler Library" and select "Import". Import the GameUpdate.XML from above.

2- Find the "GameUpdate" task in the Task Schedule Library and double click it to edit:
a- Triggers, change all 5 dates/times to the game. We do our first update at "kickoff" and then the other four are +1,2,3,4 minutes after that.
b- Actions, change the program/script to the name of your PC
c- Save this and then right click on "GameUpdate" in the Task Scheduler Library and make sure it is enabled to run. It will run at the first instance of the time and will continue running until stopped. I usually stop my that night after the game has ended.


RUNNING THE BOT ON GAMEDAY

There is a way to automate the bot task for Reddit, but I've been having issues with my environment paths not running and the bat script being unreliable, so don't do that. Instead, on gameday, when you're ready for the game to post, open up a command prompt window and type:

CD C:\Users\<name>\AppData\Local\Programs\Python\Python35 (press enter)
python C:\users\<name>\AppData\Local\Programs\Python\Python35\Scripts\GameDayBot.py

(the bot is now running, it makes its first successful post and is now updating it's own post every 15 seconds. This will continue until you press "Control + C" in the command prompt window. Be very careful: If the tasks ends, Reddit does not allow you to return to edit that post, so running the script again will create a brand new game thread....)



I think that's it. Lemme know if it's unclear or you need help.
