<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use PDF;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();
        if (request('term')) {
            $term = request('term');
            $query->where('name', 'Like', '%' . $term . '%');
        }
        $categories = $query->orderBy('id', 'DESC')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        //validate form
        $validator = $request->validate([
            'name' => 'required|string|max:50|unique:categories',
            'note' => 'nullable|string|max:255',
        ]);

        // store category
        $category = Category::create([
            'name' => $request->name,
            'note' => clean($request->note),
            'status' => $request->status
        ]);
        return redirect()->route('categories.index')->withSuccess('Category added successfully!');
    }

    public function show($slug)
    {
        return redirect()->route('categories.index');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('admin.categories.edit', compact('category'));
    }
    public function update(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();

        //validate form
        $validator = $request->validate([
            'name' => 'required|string|max:50|unique:categories,name,' . $category->id,
            'note' => 'nullable|string|max:255',
            'status'=>'required|notIn:2',
        ]);

        // update category
        $category->update([
            'name' => $request->name,
            'note' => clean($request->note),
            'status' => $request->status
        ]);
        return redirect()->route('categories.index')->withSuccess('Category updated successfully!');
    }
    public function destroy($slug)
    {
        $category = Category::where('slug', $slug)->first();
        // destroy category
        $category->delete();
        return redirect()->route('categories.index')->withSuccess('Category deleted successfully!');
    }
    public function changeStatus($slug)
    {
        $category = Category::where('slug', $slug)->first();

        // change category status
        if ($category->status == 1) {
            $category->update([
                'status' => 0
            ]);
        } else {
            $category->update([
                'status' => 1
            ]);
        }
        return redirect()->route('categories.index')->withSuccess('Category status changed successfully!');
    }

    // create pdf
    public function createPDF()
    {
        // retreive all records from db
        $data = Category::latest()->get();
        // share data to view
        view()->share('categories', $data);
        $pdf = PDF::loadView('admin.pdf.category', $data->all());
        // download PDF file with download method
        return $pdf->download('categories-list.pdf');
    }
}
