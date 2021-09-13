
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
						<li class="submenu">
							<a href="#"><i data-feather="file-text"></i> <span> Bon Livraison</span> <span
									class="menu-arrow"></span></a>
									<ul>
										<li><a href="<?=WEB_ROOT?>home/add_bl">Crée BL</a></li>
										<li><a href="#">Consulter BL</a></li>
									</ul>
						</li>
						<li class="submenu active">
							<a href="#"><i data-feather="file-text"></i> <span> Bon Commande</span> <span
									class="menu-arrow"></span></a>
									<ul>
										<li><a href="<?=WEB_ROOT?>home/add_bc" class="active">Crée BC</a></li>
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
							<h3 class="page-title">Bon Commande</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item">Bon Commande</li>
								<li class="breadcrumb-item active">Crée BC</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<form id="cart" action="<?=WEB_ROOT?>home/save_bc" method='post'>
									<div class="row">
										
										<div class="col-md-4 mt-3">
											<div class="form-group">
												<label>Société</label>
												<input type="text" class="form-control" name="societe" required>
											</div>
										</div>
										<div class="col-md-4 mt-3">
											<div class="form-group">
												<label>Date</label>
												<div>
													<input class="form-control" type="date" name="date" required>
												</div>
											</div>
										</div>
									</div>
									<div class="table-responsive mt-4">
										<table class="table table-stripped table-center table-hover" name="cart">
											<thead>
												<tr>
													<th>Designiation</th>
													<th>Unité</th>
													<th>Qté</th>
													<th>Prix Unitaire H.T.</th>
													<th>Prix Total</th>
													<th  id="addRow"><i class="fa fa-plus-square  fa-2x" style="color: green; cursor: pointer;"></i> </th>
												</tr>
											</thead>
											<tbody>
												<tr class="line_items">
													<td>
														<input type="text" name="product[]" class="form-control">
													</td>
													<td>
														<input type="text" name="unite[]" class="form-control">
													</td>
													<td>
														<input type="number" name="qte[]" min="1" class="form-control">
													</td>
													<td>
														<input type="number" name="price_unit[]" min="0"  step="0.20" class="form-control">
													</td>
													<td>
														<input type="text" name="price_total[]" jAutoCalc="{qte} * {price_unit}" class="form-control"  readonly="readonly">
													</td>
													<td class="add-remove text-right">
														<i class="fas fa-trash-alt remove"  style="color: red;"></i>
													</td>
												</tr>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td class="text-right">Total HT</td>
													<td class="text-right" style="width:183px"><input type="text" name="total_ht[]" jAutoCalc="SUM({price_total})" class="form-control" readonly="readonly"></td>
													<td></td>
												</tr>
												<tr>
													<td></td>
													<td></td>
													<td></td>									
													<td class="text-right">TVA 20%</td>
													<td class="text-right" style="width:183px"><input type="text" name="tva[]" jAutoCalc="({total_ht} * 20)/100" class="form-control" readonly="readonly"></td>
													<td></td>
												</tr>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td class="text-right">Total TTC</td>
													<td class="text-right" style="width:183px"><input type="text" name="total_ttc[]" jAutoCalc="{total_ht} + {tva}" class="form-control" readonly="readonly"></td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="text-right mt-4">
										<button type="submit" class="btn btn-primary">Crée BC</button>
									</div>
								</form>

								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="<?=WEB_ROOT?>assets/js/jquery-3.5.1.min.js"></script>
		
		<script type="text/javascript" src="<?=WEB_ROOT?>assets/js/jautocalc.js"></script>

        <script>
			/*var html='<tr class="line_items"> <td> <input type="text" name="product" class="form-control"> </td> <td> <input type="text" name="unite" class="form-control"> </td> <td> <input type="number" name="qte" min="1" class="form-control"> </td> <td> <input type="number" name="price_unit" min="0" step="0.20" class="form-control"> </td> <td> <input type="text" name="price_total" jautocalc="{qte} * {price_unit}" class="form-control" readonly="readonly"="" readonly="readonly" _jautocalc="_jautocalc"> </td> <td class="add-remove text-right"> <i class="fas fa-minus-circle remove" style="color: red;"></i> </td> </tr>';
			$('#addRow').click(function(){
				$('#dt-bl').append(html);
			})*/



			function autoCalcSetup() {
				$('form#cart').jAutoCalc('destroy');
				$('form#cart tr.line_items').jAutoCalc({keyEventsFire: true, decimalPlaces: 2, emptyAsZero: true});
				$('form#cart').jAutoCalc({decimalPlaces: 2});
			}
				autoCalcSetup();
        

			$('#addRow').on("click", function(e) {
				e.preventDefault();

				var $table = $(this).parents('table');
				
				var $top = $table.find('tr.line_items').first();
				var $new = $top.clone(true);

				$new.jAutoCalc('destroy');
				$new.insertBefore($top);
				$new.find('input[type=text]').val('');
				$new.find('input[type=number]').val('');
				autoCalcSetup();

			});

            $(document).on('click','.remove',function(){
                    
                    if(confirm("Êtes-vous sûr de supprimer cette ligne?")){
                    $(this).parents('tr').remove();
					autoCalcSetup();
                    }
                    else{
                    	return false;
                    };

            });

				

		
	    </script>
		