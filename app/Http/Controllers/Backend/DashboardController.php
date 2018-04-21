<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Repositories\Contracts\OrderRepository;
use App\Repositories\Contracts\CommentRepository;
use App\Http\Requests\Backend\UploadRequest;
use App\Services\Contracts\UploadService;
use App\Eloquent\Notification;

class DashboardController extends AbstractController
{
    protected $commentRepository;

    public function __construct(OrderRepository $order, CommentRepository $comment)
    {
        parent::__construct($order);
        $this->commentRepository = $comment;
    }

	public function index()
	{
        $this->view = 'dashboard.index';
        $this->compacts['heading'] = "Dashboards";
        $this->compacts['orderToday'] = $this->repository->statisticsToday();
        $this->compacts['orderMonthday'] = $this->repository->statisticsMonthday();
        $this->compacts['orderYearday'] = $this->repository->statisticsYearDay();
        $this->compacts['orderNoActive'] = $this->repository->statisticsOrder();
    	return $this->viewRender();
	}

	public function uploadImage(UploadRequest $request, UploadService $service)
	{
		$data = $request->all();
		return '/' . $service->image($data);
	}

	public function resize($filename, $width = 100, $height = 100)
    {
        if (strpos($filename, '/tmp/') == false) {
        } else {
            $filename = (!filter_var($filename, FILTER_VALIDATE_URL) === false) ? urldecode($filename) : public_path(urldecode($filename));
        }
        if(!\File::exists(public_path('uploads/images/resize'))) {
            \File::makeDirectory(public_path('uploads/images/resize'), $mode = 755, true);
        }
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $path = 'uploads/images/resize/' . $name . '-' . $width . 'x' . $height . '.' . $ext;
        $destinationPath = public_path($path);
        if ( ! \File::isFile($destinationPath) ) {
            $imageResize = \Image::make($filename)->fit($width, $height)->save($destinationPath);
            return \Response::make($imageResize, 200, array('Content-Type' => $ext));
        }
            return redirect(asset($path));
    }

    public function deleteComment($id)
    {
        $comment = $this->commentRepository->find($id);
        $this->commentRepository->delete($comment);
        $this->e['message'] = 'Xóa Comment Thành công..!';
        return session()->flash('flash_message', json_encode($this->e, true));
    }

    public function editComment(Request $request, $id)
    {
        $comment = $this->commentRepository->find($id);
        $comment['status'] = ($request->status == 1) ? '2' : '1';
        $comment->save();
        $this->e['message'] = 'Update Comment Thành công..!';
        //session()->flash('flash_message', json_encode($this->e, true));
        $data = [
            'text' => config('umzila.status.' . $comment->status),
            'value' => $comment->status
        ];
        return $data;
    }

    public function updateNotification($id)
    {
        $notification = app(Notification::class)->findOrFail($id);
        $notification->update(['read' => true]);
    }
}
