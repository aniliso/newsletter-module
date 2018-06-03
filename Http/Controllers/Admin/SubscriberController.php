<?php

namespace Modules\Newsletter\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Newsletter\Entities\Subscriber;
use Modules\Newsletter\Http\Requests\CreateSubscriberRequest;
use Modules\Newsletter\Http\Requests\UpdateSubscriberRequest;
use Modules\Newsletter\Repositories\SubscriberRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class SubscriberController extends AdminBaseController
{
    /**
     * @var SubscriberRepository
     */
    private $subscriber;

    public function __construct(SubscriberRepository $subscriber)
    {
        parent::__construct();

        $this->subscriber = $subscriber;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$subscribers = $this->subscriber->all();

        return view('newsletter::admin.subscribers.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('newsletter::admin.subscribers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateSubscriberRequest $request
     * @return Response
     */
    public function store(CreateSubscriberRequest $request)
    {
        $this->subscriber->create($request->all());

        return redirect()->route('admin.newsletter.subscriber.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('newsletter::subscribers.title.subscribers')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Subscriber $subscriber
     * @return Response
     */
    public function edit(Subscriber $subscriber)
    {
        return view('newsletter::admin.subscribers.edit', compact('subscriber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Subscriber $subscriber
     * @param  UpdateSubscriberRequest $request
     * @return Response
     */
    public function update(Subscriber $subscriber, UpdateSubscriberRequest $request)
    {
        $this->subscriber->update($subscriber, $request->all());

        return redirect()->route('admin.newsletter.subscriber.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('newsletter::subscribers.title.subscribers')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subscriber $subscriber
     * @return Response
     */
    public function destroy(Subscriber $subscriber)
    {
        $this->subscriber->destroy($subscriber);

        return redirect()->route('admin.newsletter.subscriber.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('newsletter::subscribers.title.subscribers')]));
    }
}