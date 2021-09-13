<div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li class="menu-title"><span>Main</span></li>
						<li>
							<a href="<?=WEB_ROOT?>home"><i data-feather="home"></i> <span>Dashboard</span></a>
						</li>
						<li class="submenu">
							<a href="#"><i data-feather="file-text"></i> <span> Facture</span> <span
									class="menu-arrow"></span></a>
							<ul>
								<li><a href="<?=WEB_ROOT?>home/add_invoice">Crée facture</a></li>
								<li><a href="#">Consulter factures</a></li>
							</ul>
						</li>
						<li class="submenu  active">
							<a href="#"><i data-feather="file-text"></i> <span> Bon Livraison</span> <span
									class="menu-arrow"></span></a>
									<ul>
										<li><a href="<?=WEB_ROOT?>home/add_bl"  class="active">Crée BL</a></li>
										<li><a href="#">Consulter BL</a></li>
									</ul>
						</li>
						<li class="submenu">
							<a href="#"><i data-feather="file-text"></i> <span> Bon Commande</span> <span
									class="menu-arrow"></span></a>
									<ul>
										<li><a href="<?=WEB_ROOT?>home/add_bc">Crée BC</a></li>
										<li><a href="#">Consulter BC</a></li>
									</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>


		<div class="page-wrapper">
			<div class="content container-fluid">

				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Bon Livraison</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item">Bon Livraison</li>
								<li class="breadcrumb-item active">Crée un BL</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<form action="<?=WEB_ROOT?>home/save_bl" method="post">
									<div class="row">
                                        <div class="col-md-4 mt-3">
											<div class="form-group">
												<label>Société</label>
												<input type="text" class="form-control" name="societe" required>
											</div>
										</div>
										<div class="col-md-4 mt-3">
											<div class="form-group">
												<label>Date Livraison</label>
												<div>
													<input class="form-control" type="date" name="date" required>
												</div>
											</div>
										</div>
										<div class="col-md-4 mt-3">
											<div class="form-group">
												<label>Référence</label>
												<input type="text" class="form-control" name="ref" required>
											</div>
										</div>
                                        <div class="col-md-4 mt-3">
											<div class="form-group">
												<label>Destination</label>
												<input type="text" class="form-control" name="destination" required>
											</div>
										</div>
										<div class="col-md-4 mt-3">
											<div class="form-group">
												<label>Transporteur</label>
												<input type="text" class="form-control" name="transporteur" required>
											</div>
										</div>
                                        <div class="col-md-4 mt-3">
											<div class="form-group">
												<label>Camion</label>
												<input type="text" class="form-control" name="camion" required>
											</div>
										</div>
									</div>
									<div class="table-responsive mt-4">
										<table class="table table-stripped table-center table-hover">
											<thead>
												<tr>
													<th>Code Article</th>
													<th>Désignation</th>
													<th>Unité</th>
													<th>Quantité</th>
													<th id="addRow"><i class="fa fa-plus-square fa-2x" style="color: green; cursor: pointer;"></i> </th>
												</tr>
											</thead>
											<tbody id='dt-bl'>
                                                <tr>
                                                    <td>
														<input type="text" name="code_art[]" class="form-control" required>
													</td>
													<td>
														<input type="text" name="designiation[]" class="form-control" required>
													</td>
													<td>
														<input type="text" name="unite[]" class="form-control" required>
													</td>
													<td>
														<input type="number" min="1" name="qte[]" class="form-control" required>
													</td>
                                                    <td class="add-remove text-right">
														<i class="fas fa-trash-alt remove"  style="color: red;"></i>
													</td>
                                                </tr>
											</tbody>
										</table>
									</div>
									
									<div class="text-right mt-4">
										<button type="submit" class="btn btn-primary">Crée BL</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        <script src="<?=WEB_ROOT?>assets/js/jquery-3.5.1.min.js"></script>

        <script>
		    
            var html='<tr> <td> <input type="text" name="code_art[]" class="form-control" required> </td> <td> <input type="text" name="designiation[]" class="form-control" required> </td> <td> <input type="text" name="unite[]" class="form-control" required> </td> <td> <input type="number" min="1" name="qte[]" class="form-control" required> </td> <td class="add-remove text-right"> <i class="fas fa-trash-alt remove"  style="color: red;"></i> </td> </tr>';
		
            $('#addRow').click(function(){
				$('#dt-bl').append(html);
			})

			$(document).on('click','.remove',function(){
				
				if(confirm("Êtes-vous sûr de supprimer cette ligne?")){
                    $(this).parents('tr').remove();
                }
                else{
                   return false;
                };
			});
		
	    </script>