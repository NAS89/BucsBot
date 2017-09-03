import praw, pdb, re, os
import time
reddit = praw.Reddit(client_id='<REDDIT CLIENT ID HERE>',
              client_secret='<CLIENT SECRET HERE>',
              password='<ENTER PASSWORD HERE>',
              user_agent='Created by <PLEASE USE THE MAINTAINER USERNAME HERE>',
              username='<ENTER USERNAME HERE>')

post = reddit.subreddit('Buccaneers').submit(
                title='Game Thread: <TEAM1> (0-0) AT <TEAM2> (2-1) ',
                selftext = '<ADD AN ALT TEXT HERE, ITS ONLY FOR THE FIRST POST>',
                url=None)

def getandstore():
	with open('thisfile.txt','r') as myfile:
		postthis = myfile.read()
		post.edit(postthis)

		
getandstore()
while True:
	getandstore()
	time.sleep(15)

