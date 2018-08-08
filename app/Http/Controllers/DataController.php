<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function eventList()
    {
    	if (request()->slug) {
    		$events = \App\Event::byCategory(request()->slug)->with('theme', 'theme.isLiked', 'theme.company')->get();
    		// $cat = \App\Category::where('slug', request()->slug)->first();
	    	// $events = \App\Event::with('theme', 'theme.isLiked', 'theme.company')
						// 	    	->whereHas('theme', function ($q) use ($cat) {
						// 				    $q->where('category_id', $cat->id);
						// 			})
	    	// 						->get();

			$cities = \App\City::has('events', '>' , 0)->withCount('events')->get();
    	} else
    	{
    		$events = \App\Event::with('theme', 'theme.isLiked', 'theme.company')->get();
    		$cities = \App\City::has('events', '>' , 0)->withCount('events')->get();
    	}

    	$data = [$events, $cities];
    	return $data;
    }

    public function eventSearch()
    {
    	$string = request()->searchQuery;
    	$events = \App\Event::with('theme')->whereHas('theme', function($q) use ($string) {
					    		$q->where('title', 'like', '%'.$string.'%');
					    	})
    						->limit(10)
							->get();
    	return $events;
    }

    public function venueList()
    {
    	$venues = \App\Venue::with('isLiked', 'company')->get();
    	$cities = \App\City::has('venues', '>' , 0)->withCount('venues')->get();
    	$data = [$venues, $cities];
    	return $data;
    }

    public function relatedEventList()
    {
    	$events = \App\Event::byCompany(request()->company_id)->get();
    	return $events;
    }

    public function getCompany()
    {
    	$company = \App\Company::with('company_detail', 'firstFiveFollowers')
				    			->where('id', request()->id)
				    			->first();
    	return $company;
    }

    public function getCompanyDetails()
    {
    	$company = \App\Company::with('company_detail', 'user', 'themes', 'events', 'venues', 'followers')
    							->where('slug', request()->slug)
    							->first();
    	return $company;
    }

    public function themeComments()
    {
    	$theme = \App\Theme::where('id', request()->id)->first();
    	$comments = $theme->comments()->with('user')->orderBy('created_at', 'desc')->get();
    	return $comments;
    }

    public function venueComments()
    {
    	$venue = \App\Venue::where('id', request()->id)->first();
    	$comments = $venue->comments()->with('user')->orderBy('created_at', 'desc')->get();
    	return $comments;
    }

    // Load venue images
    public function venueImages()
    {
    	$images = \App\VenueImage::where('venue_id', request()->id)->get();
    	return $images;
    }
}