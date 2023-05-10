<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::paginate(5);


        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);


            $categories = Category::where('id', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orWhere('slug', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(5);

            return view('backend.category.table', compact('categories'))->render();
        }

        if ($request->ajax()) {
            return view('backend.category.table', compact('categories'))->render();
        }
        return view('backend.category.index', compact('categories'))->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', '401 Error Unauthorized Access');
        }
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            if (auth()->user()->role !== 'admin') {
                return redirect()->route('dashboard')->with('error', '401 Error Unauthorized Access');
            }
            $category =   Category::create([
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('slug')),
            ]);

            if ($category) {
                return redirect()->route('category.index')->with('message', 'Category Created Successfully');
            } else {
                return redirect()->route('category.index')->with('error', 'something went wrong');
            }
        } catch (\Throwable $th) {
            return redirect()->route('category.index')->with('error', 'something went wrong');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return redirect()->route('category.index')->with('error', "Can't Find category");
            }

            if (auth()->user()->role == 'admin') {
                return view('backend.category.update', ['category' => $category]);
            }
            return redirect()->route('dashboard')->with('error', '401 Error Unauthorized Access');
        } catch (\Throwable $th) {

            return redirect()->route('dashboard')->with('error', 'something went wrong');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            if (auth()->user()->role == 'admin') {
                $category = Category::find($id)->firstorfail();

                $data = $request->all();
                $cat =  $category->update(['name' => $data['name'], 'slug' => Str::slug($data['slug'])]);

                if ($cat) {
                    return redirect()->route('category.index')->with('success', 'Category Created Successfully');
                } else {
                    return redirect()->route('category.index')->with('error', 'Can`t Create Category Now ');
                }
            }
            return redirect()->route('dashboard')->with('error', 'something went wrong');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard')->with('error', 'something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $category = Category::find($id);

            if (auth()->user()->role == 'admin' && count($category->blog) <= 0) {
                $delete  = $category->delete();
                if ($delete && $request->ajax()) {
                    return response()->json(['success' => true, 'message' => 'Record Deleted Successfully !!']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Failed to Delete !!']);
                }
            } else {
                return response()->json(['success' => false, 'message' => "Can't Delete a assigned Category !!"]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'something went wrong');
        }
    }


    /**
     * [status PATCH  update Blog Status]
     * @return [JSON] [Returns Redirect to AllBlogs]
     */
    public function status(Request $request, $id)
    {
        $model = Category::find($id);
        $model->status == '1' ? $model->status = '0' : $model->status = '1';
        $model->save();
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Status Change Successfully !!', 'data ' =>  $model->save()]);
        }
        return redirect()->back();
    }



    /**
     * [categorySlugCheck POST Check Slug ]
     * @return [JSON] [Returns Slug Taken Or Not]
     */
    public function categorySlugCheck(Request $request)
    {
        $request->validate([
            'slug' => 'required|max:200|unique:blogs',
        ]);

        $slug = Str::slug($request->input('slug'));
        $data = Category::where('slug', $slug);

        if ($request->id) {
            $data = $data->where('id', '!=', $request->id);
        }

        $data = $data->get();
        if (count($data) > 0) {

            return response()->json(['success' => false,  'message' => 'Slug is Already Taken !!',]);
        }
        return response()->json(['success' => true, 'message' => 'Done !!', 'slug' => $slug]);
    }
}
