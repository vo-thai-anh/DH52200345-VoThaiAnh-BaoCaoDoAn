@if(session('error'))
    <div style="color:red">{{ session('error') }}</div>
@endif

<h2>Thanh toán Online</h2>
<form method="POST" action="{{ route('') }}">
    @csrf
    <label>
        <input type="radio" name="gateway" value="vnpay" checked> VNPay
    </label>
    <label>
        <input type="radio" name="gateway" value="momo"> Momo
    </label>
    <label>
        <input type="radio" name="gateway" value="card"> Thẻ tín dụng
    </label>

    <div id="card-info" style="display:none;">
        <input type="text" name="card_number" placeholder="Số thẻ">
        <input type="text" name="expiry" placeholder="MM/YY">
        <input type="text" name="cvv" placeholder="CVV">
    </div>

    <button type="submit">Thanh toán</button>
</form>

<script>
    const cardRadio = document.querySelector('input[value="card"]');
    const cardInfo = document.getElementById('card-info');

    document.querySelectorAll('input[name="gateway"]').forEach(el => {
        el.addEventListener('change', () => {
            cardInfo.style.display = cardRadio.checked ? 'block' : 'none';
        });
    });
</script>
