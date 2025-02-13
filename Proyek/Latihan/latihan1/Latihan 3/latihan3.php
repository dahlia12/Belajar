<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

</head>

<body>

	
	
<table class="table mb-4">
	<thead class="table-dark">
	    <tr>
        <th scope="col">No</th>
        <th scope="col">NAMA</th>
        <th scope="col">ALAMAT</th>
		    <th scope="col">TEMPAT TINGGAL</th>
        <th scope="col">ACTION</th>
			</tr>
				</thead>
					<tbody>
						<?php for ($i=0; $i <=20 ; $i++) { ?>
							<?php if ( $i % 2 == 1 ) { ?>
								<?php $classes = 'class="table-light"'; ?>
								<?php } else { ?>
 
									<?php $classes = 'class="table-secondary"'; ?>
                                    <?php } ?>
                            <tr <?= $classes ?>>
                                <th scope="row"><?= $i+1 ?></th>
                                <td>Nama <?= $i+1 ?></td>
                                <td>Alamat <?= $i+1 ?></td>
                                <td>Tempat Tinggal <?= $i+1 ?></td>
                                <td>
                                <button type="button" class="btn border-primary">
                                <i class="fa-solid fa-pen-to-square" style="color: #3d7be6;"></i>
                                </button>
                                <button type="button" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                                </button>
                                <button type="button" class="btn border-success">
                                <i class="fa-solid fa-eye" style="color: #49ac06;"></i>
                                </button>
                                </td>
                            </tr>
					    <?php } ?>
					</tbody>
</table>


</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

</html>