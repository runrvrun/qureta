<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        $currentUserId = Auth::user()->id;
        // All threads, ignore deleted/archived participants
        // $threads = Thread::getAllLatest()->get();
        // All threads that user is participating in
         $threads = Thread::forUser($currentUserId)->latest('updated_at')->paginate(10);
        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();
        return view('messenger.index', compact('threads', 'currentUserId'));
    }
    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }
        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();
        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereIn('id', $thread->participantsUserIds($userId))->get();
        $thread->markAsRead($userId);
        return view('messenger.show', compact('thread', 'users'));
    }
    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        return view('messenger.create', ['username'=>$request->u]);
    }
    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();

        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
            ]
        );
        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );
        // Recipients
        if (Input::has('recipient')) {
            $recipients = explode(',',$input['recipient']);
            foreach($recipients as $k=>$r){
                $user = User::where('username',$r)->pluck('id');
                if(isset($user)){
                    $recipients[$k] = $user[0];
                }else{
                    unset($recipients[$k]);
                }
            }
            $thread->addParticipant($recipients);
        }
        return redirect('messages');
    }
    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');
            return redirect('messages');
        }
        $thread->activateAllParticipants();
        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
            ]
        );
        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();
        // Recipients
        if (Input::has('recipient')) {
            $recipients = explode(',',$recipient);
            $thread->addParticipant(Input::get('recipients'));
        }
        return redirect('messages');
    }

     public function autoComplete(Request $request) {
        $query = $request->get('term','');

        $user=User::where('username','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($user as $users) {
                $data[]=array('value'=>$users->username,'id'=>$users->id);
        }
        if(count($data))
             return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }

    public function destroy($id) {
        Thread::destroy($id);

        Session::flash('flash_message', 'Message deleted!');

        return redirect('messages');
    }
}
