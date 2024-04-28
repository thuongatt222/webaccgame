<?php

namespace App\Http\Controllers;

use App\Models\Accessories;
use App\Models\Nick;
use App\Models\Category;
use Illuminate\Http\Request;

class NickController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nick = Nick::with('category')->orderBy('id', 'DESC')->paginate(5);
        return view('admin.nick.index', compact('nick'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        return  view('admin.nick.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:nicks|max:255',
            'category_id' => 'required|max:255',
            'description' => 'required|max:255',
            'status' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:png,jpg,gif,svg,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
        ], [
            'title.unique' => 'Tên nick game đã có xin điền tên khác',
            'title.required' => 'Tên nick game phải có',
            'category_id.required' => 'Danh mục nick game phải có',
            'description.required' => 'Mô tả nick game phải có',
            'image.required' => 'Hình ảnh phải có',
            'price.required' => 'Giá phải có',
        ]);
        $attribute = [];
        foreach ($data['attribute'] as $key => $attri) {
            foreach ($data['name_attribute'] as $key2 => $name_attri) {
                if ($key == $key2) {
                    $attribute[] = $name_attri . ': ' . $attri;
                }
            }
        }
        $nick = new Nick();
        $nick->title = $data['title'];
        $nick->ms = random_int(100000, 999999);
        $nick->attribute = json_encode($attribute, JSON_UNESCAPED_UNICODE);
        $nick->category_id = $data['category_id'];
        $nick->price = $data['price'];
        $nick->description = $data['description'];
        $nick->status = $data['status'];

        $get_image = $request->image;
        $path = 'uploads/nick/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $nick->image = $new_image;
        $nick->save();
        return redirect()->route('nick.index')->with('status', 'Thêm nick thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nick $nick)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $nick = Nick::find($id);
        return view('admin.nick.edit', compact('nick'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|unique:nicks|max:255',
            'category_id' => 'required|max:255',
            'attribute' => 'required|max:255',
            'description' => 'required|max:255',
            'status' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:png,jpg,gif,svg,jpeg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
        ], [
            'title.unique' => 'Tên nick game đã có xin điền tên khác',
            'title.required' => 'Tên nick game phải có',
            'category_id.required' => 'Danh mục nick game phải có',
            'description.required' => 'Mô tả nick game phải có',
            'price.required' => 'Giá phải có',
            'attribute.required' => 'Thuộctính nick game phải có',
        ]);
        $nick = Nick::find($id);
        $nick->title = $data['title'];
        $nick->attribute = $data['attribute'];
        $nick->category_id = $data['category_id'];
        $nick->price = $data['price'];
        $nick->description = $data['description'];
        $nick->status = $data['status'];
        $get_image = $request->image;
        if ($get_image) {
            $path_unlink = 'uploads/nick/' . $nick->image;
            if (file_exists($path_unlink)) {
                unlink($path_unlink);
            }
            $path = 'uploads/nick/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $nick->image = $new_image;
        }
        $nick->save();
        return redirect()->route('nick.index')->with('status', 'Cập nhật nick thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nick = Nick::find($id);
        $path_unlink = 'uploads/nick/' . $nick->image;
        if (file_exists($path_unlink)) {
            unlink($path_unlink);
        }
        $nick->delete();
        return redirect()->route('nick.index')->with('status', 'Xóa nick thành công');
    }

    public function choose_category(Request $request)
    {
        $data = $request->all();
        $accessories = Accessories::where('category_id', $data['category_id'])->get();
        $output = "";
        foreach ($accessories as $key => $acc) {
            $output .= '
            <div class="form-group">
                <label for="exampleInputEmail1">' . $acc->title . '</label>
                <input type="hidden" value = "' . $acc->title . '" name = "name_attribute[]">
                <input type="text" class="form-control" name="attribute[]" placeholder="...">
            </div>
        ';
        }
        return $output; // Return $output instead of echoing it
    }
}
