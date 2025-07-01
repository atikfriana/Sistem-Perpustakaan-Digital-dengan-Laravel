<script>
document.querySelectorAll('.favorite-btn').forEach(button => {
  button.addEventListener('click', function() {
    const bookId = this.dataset.bookId;

    fetch(/books/${bookId}/favorite, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
      if(data.status === 'added'){
        this.innerHTML = '<i class="fas fa-heart text-red-600"></i>';
      } else if(data.status === 'removed'){
        this.innerHTML = '<i class="far fa-heart"></i>';
      }
    })
    .catch(error => console.error('Error:', error));
  });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if(session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
