SMILE Wordpress Starter Theme

Always fork this repo, do not modify this repo directly unless updating to a new version.

This theme includes all of the base template files, folder structure, gulp file and npm package.
This theme required the Bartender plugin (smile-bartender).

Run setup.sh in terminal to begin development.

> Ice.js (SMILE Javascript Functions) (paralax/modals/smooth scroll/match height/string verification)
		paralax			- data-paralax="x", where x=speed
		modals			- data-modal="true",
						- href="#id" / href="###.jpg" / href="youtube.com/watch=###"
						- Element / Image / Embed
						- integrate with html5 modal
		smooth scroll	- href="#id" detection, data-smooth="false" to disable
		Faster Scroll	- https://gist.github.com/Warry/4254579


Installing a demo for 360 Experience:

    Required pluguns: 
    - ACF
    - Bartender
    
    Required pages: 
    - '360 Experience' (slug's got to be /360-experience/ )
    
    On that page, create some repeater fields in order to pre-populate the sidebar
    
    For the nicer view create a primary menu with some menu items
    
    Current 360 video is built using Valiant360 and is draggable on click.