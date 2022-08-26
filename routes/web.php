<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master;
use App\Http\Controllers\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clearcache', function() { Artisan::call('cache:clear'); return "Cache is cleared"; });
Route::get('/', function () { return view('template.login'); });
Route::get('/login', function () { return view('template.login'); });
Route::get('/dashboard', function () { return view('template.dashboard'); });

/*--------- Itemcategory -----------*/

Route::get('/itemcategory', function () { return view('itemcategory.list'); });
Route::post('/itemcategoryDatalist',[Master::class,'itemcategoryDatalist'])->name('itemcategoryDatalist');
Route::post('/save-itemcategory',[Master::class,'saveItemCategory'])->name('save-itemcategory');
Route::post('/edit-itemcategory',[Master::class,'editItemCategory'])->name('edit-itemcategory');
Route::post('/delete-itemcategory',[Master::class,'deleteItemCategory'])->name('delete-itemcategory');

/*--------- UOM -----------*/

Route::get('/uom', function () { return view('uom.list'); });
Route::post('/uomDatalist',[Master::class,'uomDatalist'])->name('uomDatalist');
Route::post('/save-uom',[Master::class,'saveuom'])->name('save-uom');
Route::post('/edit-uom',[Master::class,'edituom'])->name('edit-uom');
Route::post('/delete-uom',[Master::class,'deleteuom'])->name('delete-uom');

/*--------- Department -----------*/

Route::get('/department', function () { return view('department.list'); });
Route::post('/departmentDatalist',[Master::class,'departmentDatalist'])->name('departmentDatalist');
Route::post('/save-department',[Master::class,'savedepartment'])->name('save-department');
Route::post('/edit-department',[Master::class,'editdepartment'])->name('edit-department');
Route::post('/delete-department',[Master::class,'deletedepartment'])->name('delete-department');

/*--------- Employee Desigination -----------*/

Route::get('/employeerole', function () { return view('employeerole.list'); });
Route::post('/employeeroleDatalist',[Master::class,'employeeroleDatalist'])->name('employeeroleDatalist');
Route::post('/save-employeerole',[Master::class,'saveemployeerole'])->name('save-employeerole');
Route::post('/edit-employeerole',[Master::class,'editemployeerole'])->name('edit-employeerole');
Route::post('/delete-employeerole',[Master::class,'deleteemployeerole'])->name('delete-employeerole');

/*--------- Expense Type -----------*/

Route::get('/expensetype', function () { return view('expensetype.list'); });
Route::post('/expensetypeDatalist',[Master::class,'expensetypeDatalist'])->name('expensetypeDatalist');
Route::post('/save-expensetype',[Master::class,'saveexpensetype'])->name('save-expensetype');
Route::post('/edit-expensetype',[Master::class,'editexpensetype'])->name('edit-expensetype');
Route::post('/delete-expensetype',[Master::class,'deleteexpensetype'])->name('delete-expensetype');

/*--------- Customer Category -----------*/

Route::get('/customercategory', function () { return view('customercategory.list'); });
Route::post('/customercategoryDatalist',[Master::class,'customercategoryDatalist'])->name('customercategoryDatalist');
Route::post('/save-customercategory',[Master::class,'savecustomercategory'])->name('save-customercategory');
Route::post('/edit-customercategory',[Master::class,'editcustomercategory'])->name('edit-customercategory');
Route::post('/delete-customercategory',[Master::class,'deletecustomercategory'])->name('delete-customercategory');

/*--------- Terms and Condition -----------*/

Route::get('/terms', function () { return view('terms.list'); });
Route::post('/termsDatalist',[Master::class,'termsDatalist'])->name('termsDatalist');
Route::post('/save-terms',[Master::class,'saveterms'])->name('save-terms');
Route::post('/edit-terms',[Master::class,'editterms'])->name('edit-terms');
Route::post('/delete-terms',[Master::class,'deleteterms'])->name('delete-terms');

/*--------- ID Proof -----------*/

Route::get('/idproof', function () { return view('idproof.list'); });
Route::post('/idproofDatalist',[Master::class,'idproofDatalist'])->name('idproofDatalist');
Route::post('/save-idproof',[Master::class,'saveidproof'])->name('save-idproof');
Route::post('/edit-idproof',[Master::class,'editidproof'])->name('edit-idproof');
Route::post('/delete-idproof',[Master::class,'deleteidproof'])->name('delete-idproof');


/*--------- Tax Type -----------*/

Route::get('/taxtype', function () { return view('taxtype.list'); });
Route::post('/taxtypeDatalist',[Master::class,'taxtypeDatalist'])->name('taxtypeDatalist');
Route::post('/save-taxtype',[Master::class,'savetaxtype'])->name('save-taxtype');
Route::post('/edit-taxtype',[Master::class,'edittaxtype'])->name('edit-taxtype');
Route::post('/delete-taxtype',[Master::class,'deletetaxtype'])->name('delete-taxtype');

/*--------- Warehouse -----------*/

Route::get('/warehouse', function () { return view('warehouse.list'); });
Route::post('/warehouseDatalist',[Master::class,'warehouseDatalist'])->name('warehouseDatalist');
Route::post('/save-warehouse',[Master::class,'savewarehouse'])->name('save-warehouse');
Route::post('/edit-warehouse',[Master::class,'editwarehouse'])->name('edit-warehouse');
Route::post('/delete-warehouse',[Master::class,'deletewarehouse'])->name('delete-warehouse');

/*--------- Employee -----------*/

Route::get('/employee', function () { return view('employee.list'); });
Route::get('/form-employee/{id}',function () { return view('employee.form'); })->name('form-employee/{id}');
Route::post('/employeeDatalist',[Master::class,'employeeDatalist'])->name('employeeDatalist');
Route::post('/save-employee',[Master::class,'saveemployee'])->name('save-employee');
Route::post('/get-employee-options',[Master::class,'getEmployeeOptions'])->name('get-employee-options');
Route::post('/get-employee-details',[Master::class,'getEmployeeDetails'])->name('get-employee-details');
Route::post('/delete-employee',[Master::class,'deleteemployee'])->name('delete-employee');

/*--------- Supplier -----------*/

Route::get('/supplier', function () { return view('supplier.list'); });
Route::get('/form-supplier/{id}',function () { return view('supplier.form'); })->name('form-supplier/{id}');
Route::post('/supplierDatalist',[Master::class,'supplierDatalist'])->name('supplierDatalist');
Route::post('/save-supplier',[Master::class,'savesupplier'])->name('save-supplier');
Route::post('/get-supplier-details',[Master::class,'getsupplierDetails'])->name('get-supplier-details');
Route::post('/delete-supplier',[Master::class,'deletesupplier'])->name('delete-supplier');

/*--------- Customer -----------*/

Route::get('/customer', function () { return view('customer.list'); });
Route::get('/form-customer/{id}',function () { return view('customer.form'); })->name('form-customer/{id}');
Route::post('/customerDatalist',[Master::class,'customerDatalist'])->name('customerDatalist');
Route::post('/save-customer',[Master::class,'savecustomer'])->name('save-customer');
Route::post('/get-customer-details',[Master::class,'getcustomerDetails'])->name('get-customer-details');
Route::post('/get-customer-options',[Master::class,'getCustomerOptions'])->name('get-customer-options');
Route::post('/delete-customer',[Master::class,'deletecustomer'])->name('delete-customer');

/*--------- Tax -----------*/

Route::get('/tax', function () { return view('tax.list'); });
Route::get('/form-tax/{id}',function () { return view('tax.form'); })->name('form-tax/{id}');
Route::post('/taxDatalist',[Master::class,'taxDatalist'])->name('taxDatalist');
Route::post('/save-tax',[Master::class,'savetax'])->name('save-tax');
Route::post('/get-tax-details',[Master::class,'getTaxDetails'])->name('get-tax-details');
Route::post('/get-tax-options',[Master::class,'getTaxOptions'])->name('get-tax-options');
Route::post('/delete-tax',[Master::class,'deletetax'])->name('delete-tax');

/*--------- Company -----------*/

Route::get('/company', function () { return view('company.list'); });
Route::get('/form-company/{id}',function () { return view('company.form'); })->name('form-company/{id}');
Route::post('/companyDatalist',[Master::class,'companyDatalist'])->name('companyDatalist');
Route::post('/save-company',[Master::class,'savecompany'])->name('save-company');
Route::post('/get-company-details',[Master::class,'getCompanyDetails'])->name('get-company-details');
Route::post('/delete-company',[Master::class,'deletecompany'])->name('delete-company');

/*--------- Branch -----------*/

Route::get('/branch', function () { return view('branch.list'); });
Route::get('/form-branch/{id}',function () { return view('branch.form'); })->name('form-branch/{id}');
Route::post('/branchDatalist',[Master::class,'branchDatalist'])->name('branchDatalist');
Route::post('/save-branch',[Master::class,'savebranch'])->name('save-branch');
Route::post('/get-branch-details',[Master::class,'getBranchDetails'])->name('get-branch-details');
Route::post('/get-branch-options',[Master::class,'getBranchOptions'])->name('get-branch-options');
Route::post('/delete-branch',[Master::class,'deletebranch'])->name('delete-branch');

/*--------- Payment Terms -----------*/

Route::get('/paymentterms', function () { return view('paymentterms.list'); });
Route::post('/paymenttermsDatalist',[Master::class,'paymenttermsDatalist'])->name('paymenttermsDatalist');
Route::post('/save-paymentterms',[Master::class,'savepaymentterms'])->name('save-paymentterms');
Route::post('/edit-paymentterms',[Master::class,'editpaymentterms'])->name('edit-paymentterms');
Route::post('/delete-paymentterms',[Master::class,'deletepaymentterms'])->name('delete-paymentterms');

/*--------- Shipping -----------*/

Route::get('/shipping', function () { return view('shipping.list'); });
Route::post('/shippingDatalist',[Master::class,'shippingDatalist'])->name('shippingDatalist');
Route::post('/save-shipping',[Master::class,'saveshipping'])->name('save-shipping');
Route::post('/edit-shipping',[Master::class,'editshipping'])->name('edit-shipping');
Route::post('/delete-shipping',[Master::class,'deleteshipping'])->name('delete-shipping');

/*--------- Freight Terms -----------*/

Route::get('/freightterms', function () { return view('freightterms.list'); });
Route::post('/freighttermsDatalist',[Master::class,'freighttermsDatalist'])->name('freighttermsDatalist');
Route::post('/save-freightterms',[Master::class,'savefreightterms'])->name('save-freightterms');
Route::post('/edit-freightterms',[Master::class,'editfreightterms'])->name('edit-freightterms');
Route::post('/delete-freightterms',[Master::class,'deletefreightterms'])->name('delete-freightterms');

/*--------- FOB -----------*/

Route::get('/fob', function () { return view('fob.list'); });
Route::post('/fobDatalist',[Master::class,'fobDatalist'])->name('fobDatalist');
Route::post('/save-fob',[Master::class,'savefob'])->name('save-fob');
Route::post('/edit-fob',[Master::class,'editfob'])->name('edit-fob');
Route::post('/delete-fob',[Master::class,'deletefob'])->name('delete-fob');

/*--------- Item -----------*/

Route::get('/item', function () { return view('item.list'); });
Route::get('/form-item/{id}',function () { return view('item.form'); })->name('form-item/{id}');
Route::post('/itemDatalist',[Master::class,'itemDatalist'])->name('itemDatalist');
Route::post('/save-item',[Master::class,'saveitem'])->name('save-item');
Route::post('/get-item-options',[Master::class,'getitemOptions'])->name('get-item-options');
Route::post('/get-item-details',[Master::class,'getitemDetails'])->name('get-item-details');
Route::post('/delete-item',[Master::class,'deleteitem'])->name('delete-item');