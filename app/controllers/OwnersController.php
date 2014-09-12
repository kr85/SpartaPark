<?php

class OwnersController extends \BaseController {

	/**
	 * Display a listing of owners
	 *
	 * @return Response
	 */
	public function index()
	{
		$owners = Owner::all();

		return View::make('owners.index', compact('owners'));
	}

	/**
	 * Show the form for creating a new owner
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('owners.create');
	}

	/**
	 * Store a newly created owner in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Owner::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Owner::create($data);

		return Redirect::route('owners.index');
	}

	/**
	 * Display the specified owner.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$owner = Owner::findOrFail($id);

		return View::make('owners.show', compact('owner'));
	}

	/**
	 * Show the form for editing the specified owner.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$owner = Owner::find($id);

		return View::make('owners.edit', compact('owner'));
	}

	/**
	 * Update the specified owner in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$owner = Owner::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Owner::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$owner->update($data);

		return Redirect::route('owners.index');
	}

	/**
	 * Remove the specified owner from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Owner::destroy($id);

		return Redirect::route('owners.index');
	}

}
