namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Category;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        // compact()は引数名と変数名が同じなら使えるのでOK
        return view('index', ['categories' => Category::all()]);
    }

    public function confirm(ContactRequest $request)
    {
        // tel1, tel2, tel3 は最初から $request->only() には含まれていないので
        // 個別に取得する必要はあるけど変数代入はまとめてOK
        $contact = $request->only([
            'last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail'
        ]) + $request->only(['tel1', 'tel2', 'tel3']);

        // tel は文字列連結なので簡潔にまとめる
        $contact['tel'] = $contact['tel1'] . $contact['tel2'] . $contact['tel3'];

        session(['contact' => $contact]);

        return view('confirm', [
            'contact' => $contact,
            'categories' => Category::all(),
        ]);
    }

    public function store(ContactRequest $request)
    {
        // sessionからそのままcreateの引数として渡せるなら一気に渡す
        Contact::create(session('contact'));

        return view('thanks');
    }

    public function edit()
    {
        // セッションのcontact配列をwithInputでフォームに戻すだけ
        return redirect('/')->withInput(session('contact', []));
    }
}
