<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
        </div>
    </header>
    <main>
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2>Contact</h2>
            </div>

            <form class="form" action="/contacts/confirm" method="POST">
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <div class="form__input--name">
                                <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name', $contact['last_name'] ?? '') }}" />
                                <span class="separator"></span>

                                <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name', $contact['first_name'] ?? '') }}" />
                            </div>
                            <div class="error-name">
                                <div class="form__error">
                                    @error('last_name')
                                    {{ $message }}
                                    @enderror
                                </div>
                                <div class="form__error">
                                    @error('first_name')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">性別</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="radio-group">
                            <label><input type="radio" name="gender" class="gender_input" value="男性" checked {{ old('gender', $contact['gender'] ?? '') == '男性' ? 'checked' : '' }}>男性</label>
                            <label><input type="radio" name="gender" class="gender_input" value="女性" {{ old('gender', $contact['gender'] ?? '') == '女性' ? 'checked' : '' }}>女性</label>
                            <label><input type="radio" name="gender" class="gender_input" value="その他" {{ old('gender', $contact['gender'] ?? '') == 'その他' ? 'checked' : '' }}>その他</label>
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="test@example.com" value="{{ old('email', $contact['email'] ?? '') }}" />
                            <div class="form__error">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>



                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">電話番号</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <div class="form__input--tel">
                                <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1', $contact['tel1'] ?? '') }}">
                                <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2', $contact['tel2'] ?? '') }}">
                                <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3', $contact['tel3'] ?? '') }}">
                            </div>
                            <div class="error-tel">
                                <div class="form__error">
                                    @error('tel1')
                                    {{ $message }}
                                    @enderror
                                </div>
                                <div class="form__error">
                                    @error('tel2')
                                    {{ $message }}
                                    @enderror
                                </div>
                                <div class="form__error">
                                    @error('tel3')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">住所</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', $contact['address'] ?? '') }}" />
                            <div class="form__error">
                                @error('address')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">建物名</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building', $contact['building'] ?? '') }}" />
                        </div>
                    </div>
                </div>

                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせの種類</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <select name="category_id" class="form__select">
                            <option value="">選択してください</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $contact['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->content }}
                            </option> @endforeach
                        </select>
                        <div class="form__error">
                            @error('category_id')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせ内容</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--textarea">
                            <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', $contact['detail'] ?? '') }}</textarea>
                            <div class="form__error">
                                @error('detail')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>

            </form>
        </div>
    </main>
</body>