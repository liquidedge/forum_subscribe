<h1>Forum subscriptions module</h1>
## Maintainers

 * David <studio at liquidedge dot co dot nz>

## Introduction

This module extends forum module, so that logged/registered user can subscribe to all posts/new threads via email notification


## Requirements

 * SilverStripe 3.1

## Installation

## Manual directory placement

Place this directory in the root of your SilverStripe installation. 

Make sure it is renamed 'forum_subscribe'

Rebuild your database (see below).

## Rebuild database

Visit http://www.yoursite.com/dev/build/ in your browser 

## to show subscribe/unsubscribe links
Place the $SubscribeLink placeholder in ForumHeader.ss

## flush the cache
Also flush the cache http://www.yoursite.com/?flush=all in your browser 

## note
To set From and ReplyTo address of email, visit 'subscriptions' tab under the respective forum holder





