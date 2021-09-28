<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::orderBy('time', 'DESC')->get();
        $response = [
            'message' => 'List transaction order by time',
            'status' => Response::HTTP_OK,
            'data' => $transaction
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $saveTransaction = new Transaction;

        $saveTransaction->title = $request->title;
        $saveTransaction->amount = $request->amount;
        $saveTransaction->type = $request->type;

        $saveTransaction->save();

        $response = [
            'message' => 'success created transaction',
            'status' => Response::HTTP_CREATED,
            'data' => $saveTransaction
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getIdTransaction = new TransactionResource(Transaction::findOrFail($id));
        $response = [
            'message' => 'success updated transaction',
            'status' => Response::HTTP_OK,
            'data' => $getIdTransaction
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $updateTransaction = Transaction::findOrFail($id);

        $updateTransaction->title = $request->title;
        $updateTransaction->amount = $request->amount;
        $updateTransaction->type = $request->type;

        $updateTransaction->save();

        $response = [
            'message' => 'success updated transaction',
            'status' => Response::HTTP_OK,
            'data' => $updateTransaction
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $updateTransaction = Transaction::findOrFail($id);

        $updateTransaction->delete();

        $response = [
            'message' => 'success deleted transaction',
            'status' => Response::HTTP_OK,
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
