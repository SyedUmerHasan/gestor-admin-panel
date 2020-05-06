<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Session;

use Google\Cloud\Firestore\FirestoreClient;

class FirebaseController extends Controller
{
    private $serviceAccount;
    private $firebase;
    private $firestore;
    private $query;
    private $allUsersDocs;

    public function __construct()
    {
        $this->firestore = new FirestoreClient([
            'projectId' => 'the-gestor',
        ]);
        $this->query = $this->firestore->collection('Users');
        $this->allUsersDocs = $this->query->documents();
    }

    public function getAllUsersData(){

        if(empty($this->allUsersDocs) || $this->allUsersDocs == null) 
        {
            $this->getuserDocs();
        }
        $mydata = array();
        foreach ($this->allUsersDocs as $document) {
            if ($document->exists()) {
                $tempArray["id"] =  $document->id();
                $tempArray["data"] =  $document->data();
                array_push($mydata, $tempArray);
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
            }
        }
        
        $mydata = array(
            "data" => $mydata
        );
        return response()->json($mydata);
    }

    public function getUsersDataById($id){
        if(empty($this->allUsersDocs) || $this->allUsersDocs == null) 
        {
            $this->getuserDocs();
        }
        $tempArray = null;
        foreach ($this->allUsersDocs as $document) {
            if ($document->exists()) {
                if($document->id() == $id){
                    $tempArray["id"] =  $document->id();
                    $tempArray["data"] =  $document->data();
                }
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
            }
        }
        return response()->json($tempArray);
    }

    public function updateuser(Request $request, $id){
        Session::flash('success', "User has been updated successfully");
        if(empty($this->query) || $this->query == null) 
        {
            $this->getQueries();
        }
        $data = $this->query->document($id);
        $data->update([            
            ['path' => 'fname', 'value' =>  $request->fname],
            ['path' => 'lname', 'value' =>  $request->lname],
            ['path' => 'plan', 'value' => $request->plan],
            ['path' => 'describe', 'value' => $request->describe ]
        ]);
        return redirect()->route("user",$id);
    }

    public function updateExpense(Request $request, $userid, $expenseid){
        
        if(empty($this->query) || $this->query == null) 
        {
            $this->getQueries();
        }
        try {
            $data = $this->query->document($userid)->collection("expense")->document($expenseid);
            $data->update([            
                ['path' => 'status', 'value' =>  $request->status],
                ['path' => 'concept', 'value' =>  $request->concept],
                ['path' => 'taxable', 'value' => $request->taxable],
                ['path' => 'note', 'value' => $request->note],
                ['path' => 'irpf', 'value' => $request->irpf ],
                ['path' => 'amount', 'value' => $request->amount],
                ['path' => 'iva', 'value' => $request->iva ],
                ['path' => 'client', 'value' => $request->Client ]
            ]);
            Session::flash('success', "User has been updated successfully");
        } catch (\Throwable $th) {
            Session::flash('danger', "please contact system administrator for help");
        }

        return redirect()->route("expense.view",[$userid, $expenseid]);
    }
    

    public function updateIncome(Request $request, $userid, $incomeid){
        
        if(empty($this->query) || $this->query == null) 
        {
            $this->getQueries();
        }
        try {
            $data = $this->query->document($userid)->collection("income")->document($incomeid);
            $data->update([            
                ['path' => 'status', 'value' =>  $request->status],
                ['path' => 'concept', 'value' =>  $request->concept],
                ['path' => 'taxable', 'value' => $request->taxable],
                ['path' => 'note', 'value' => $request->note],
                ['path' => 'irpf', 'value' => $request->irpf ],
                ['path' => 'amount', 'value' => $request->amount],
                ['path' => 'iva', 'value' => $request->iva ],
                ['path' => 'client', 'value' => $request->Client ]
            ]);
            Session::flash('success', "Income has been updated successfully");
        } catch (\Throwable $th) {
            Session::flash('danger', "please contact system administrator for help");
        }

        return redirect()->route("income.view",[$userid, $incomeid]);
    }
    

    public function updateContact(Request $request, $userid, $expenseid){
        
        if(empty($this->query) || $this->query == null) 
        {
            $this->getQueries();
        }
        try {
            $data = $this->query->document($userid)->collection("expense")->document($expenseid);
            $data->update([            
                ['path' => 'status', 'value' =>  $request->status],
                ['path' => 'concept', 'value' =>  $request->concept],
                ['path' => 'taxable', 'value' => $request->taxable],
                ['path' => 'note', 'value' => $request->note],
                ['path' => 'irpf', 'value' => $request->irpf ],
                ['path' => 'amount', 'value' => $request->amount],
                ['path' => 'iva', 'value' => $request->iva ],
                ['path' => 'client', 'value' => $request->Client ]
            ]);
            Session::flash('success', "User has been updated successfully");
        } catch (\Throwable $th) {
            Session::flash('danger', "please contact system administrator for help");
        }

        return redirect()->route("contact.view",[$userid, $expenseid]);
    }

    public function getUsersContactById($id){
        if(empty($this->query) || $this->query == null) 
        {
            $this->getQueries();
        }
        $data = $this->query->document($id)->collection("contacts")->documents();
        $mydata = array();
        foreach ($data as $document) {
            if ($document->exists()) {
                $tempArray["id"] =  $document->id();
                $tempArray["data"] =  $document->data();
                array_push($mydata, $tempArray);
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
            }
        }
        
        $mydata = array(
            "data" => $mydata
        );
        return response()->json($mydata);
    }
    
    public function getUsersExpenseById($id){
        if(empty($this->query) || $this->query == null) 
        {
            $this->getQueries();
        }
        $data = $this->query->document($id)->collection("expense")->documents();
        $mydata = array();
        foreach ($data as $document) {
            if ($document->exists()) {
                $tempArray["id"] =  $document->id();
                $tempArray["data"] =  $document->data();
                array_push($mydata, $tempArray);
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
            }
        }
        
        $mydata = array(
            "data" => $mydata
        );
        return response()->json($mydata);
    }
    public function getExpenseByUserIDandExpenseID($id, $expenseid){
        if(empty($this->query) || $this->query == null) 
        {
            $this->getQueries();
        }
        $data = $this->query->document($id)->collection("expense")->documents();
        $mydata;
        foreach ($data as $document) {
            if ($document->exists()) {
                if($document->id() == $expenseid){
                    $mydata["id"] =  $document->id();
                    $mydata["data"] =  $document->data();
                }

            } else {
                printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
            }
        }
        
        return response()->json($mydata);
    }
    
    public function getIncomeByUserIDandExpenseID($id, $incomeid){
        if(empty($this->query) || $this->query == null) 
        {
            $this->getQueries();
        }
        $data = $this->query->document($id)->collection("income")->documents();
        $mydata = [];
        foreach ($data as $document) {
            if ($document->exists()) {
                if($document->id() == $incomeid){
                    $mydata["id"] =  $document->id();
                    $mydata["data"] =  $document->data();
                }

            } else {
                printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
            }
        }
        
        return response()->json($mydata);
    }
    public function getcontactByUserIDandExpenseID($id, $contactid){
        if(empty($this->query) || $this->query == null) 
        {
            $this->getQueries();
        }
        $data = $this->query->document($id)->collection("contacts")->documents();
        $mydata = [];
        foreach ($data as $document) {
            if ($document->exists()) {
                if($document->id() == $contactid){
                    $mydata["id"] =  $document->id();
                    $mydata["data"] =  $document->data();
                }
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
            }
        }
        
        return response()->json($mydata);
    }

    public function getUsersIncomeById($id){
        if(empty($this->query) || $this->query == null) 
        {
            $this->getQueries();
        }
        $data = $this->query->document($id)->collection("income")->documents();
        $mydata = array();
        foreach ($data as $document) {
            if ($document->exists()) {
                $tempArray["id"] =  $document->id();
                $tempArray["data"] =  $document->data();
                array_push($mydata, $tempArray);
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
            }
        }
        
        $mydata = array(
            "data" => $mydata
        );
        return response()->json($mydata);
    }

    private function getuserDocs(){
        if(empty($this->query) || $this->query == null) 
        {
            $this->getQueries();
        }
        $this->allUsersDocs = $this->query->documents();
    }
    private function getQueries(){
        if(empty($this->firestore) || $this->firestore == null) 
        {
            $this->getfirestore();
        }
        $this->query = $this->firestore->collection('Users');
    }
    private function getfirestore(){
        $this->firestore = new FirestoreClient([
            'projectId' => 'the-gestor',
        ]);
    }


}
