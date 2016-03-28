<?php

namespace App\Back\Http\Controllers\Documents;

use App\Back\Http\Controllers\BackController;
use App\Back\Http\Requests\Documents\ImageRequest;
use App\Core\Models\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Redirect;

class ImagesController extends BackController
{
    /**
     * List of images
     *
     * @return mixed
     */
    public function index()
    {
        $records = Image::paginate(9);

        return view('back::documents.images.index', compact('records'));
    }

    /**
     * Form to create a new image
     *
     * @return mixed
     */
    public function create()
    {
        return view('back::documents.images.create');
    }

    /**
     * Persist image
     *
     * @param ImageRequest $request
     * @return mixed
     */
    public function store(ImageRequest $request)
    {
        $record = new Image();
        $record->title = $request->get('title');
        $record->file = $this->uploadImage($request->file('image'));
        $record->tags = $request->get('tags');
        $record->description = $request->get('description');

        if ($record->save()) {
            $this->addFlash(trans('back::dictionary.success'), 'success');

            return Redirect::route('back.documents.images.index');
        } else {
            $this->addFlash(trans('back::dictionary.exception'), 'danger');

            return Redirect::route('back.documents.images.create')->withInputs();
        }
    }

    /**
     * Form to update image
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $record = Image::find($id);

        return view('back::documents.images.edit', compact('record'));
    }

    /**
     * Update image data
     *
     * @param $id
     * @param ImageRequest $request
     * @return mixed
     */
    public function update($id, ImageRequest $request)
    {
        $record = Image::find($id);
        $record->title = $request->get('title');
        $record->tags = $request->get('tags');
        $record->description = $request->get('description');

        if ($request->file('image') && $request->file('image')->isValid()) {
            $record->file = $this->uploadImage($request->file('image'), $record->file);
        }

        if ($record->save()) {
            $this->addFlash(trans('back::dictionary.success'), 'success');

            return Redirect::route('back.documents.images.index');
        } else {
            $this->addFlash(trans('back::dictionary.exception'), 'danger');

            return Redirect::route('back.documents.images.create')->withInputs();
        }
    }

    /**
     * Form to update image
     *
     * @param $id
     * @return mixed
     */
    public function getCrop($id)
    {
        $record = Image::find($id);

        return view('back::documents.images.crop', compact('record'));
    }

    /**
     * @param UploadedFile $file
     * @return array|null|\Symfony\Component\HttpFoundation\File\UploadedFile
     */
    private function uploadImage(UploadedFile $file, $name = null)
    {
        if ($name === null) {
            $name = implode('.', [md5(uniqid('', true)), $file->getClientOriginalExtension()]);
        }

        if ($file->isValid()) {
            if ($file->move(storage_path('app/images'), $name)) {
                return $name;
            }
        }

        return false;
    }
}
