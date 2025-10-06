<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DocumentRequest as EntityRequest;
use App\Repositories\Document\DocumentRepositoryInterface as EntityRepositoryInterface;
use App\Repositories\InfoDocument\InfoDocumentRepositoryInterface;
use App\Models\Document as Entity;
use App\Models\InfoDocument;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Exception;

class DocumentController extends BaseController
{
    public function __construct(EntityRepositoryInterface $entityRepository, InfoDocumentRepositoryInterface $infoDocumentRepository)
    {
        $this->module = 'documents';
        $this->repository = $entityRepository;
        $this->infoDocumentRepository = $infoDocumentRepository;
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies($this->module . '_access'), 403);
        try {
            list($results, $summary) = $this->repository->list($request);
            $data =  [
                'results' => $results,
                'summary' => $summary,
                'module'  => $this->module,
            ];
            return view('backend.' . $this->module . '.index', $data);
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function create()
    {
        abort_if(Gate::denies($this->module . '_create'), 403);
        return view('backend.' . $this->module . '.create', $this->formData(new Entity()));
    }

    public function store(EntityRequest $request)
    {
        abort_if(Gate::denies($this->module . '_create'), 403);
        try {
            $this->repository->create($this->getDataRequest($request));
            return redirect()->route('admin.' . $this->module . '.index')
                             ->with('resp_success', 'Thực hiện thao tác thành công');
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function edit(Entity $entity)
    {
        abort_if(Gate::denies($this->module . '_edit'), 403);
        return view('backend.' . $this->module . '.edit', $this->formData($entity));
    }

    public function update(EntityRequest $request, Entity $entity)
    {
        abort_if(Gate::denies($this->module . '_edit'), 403);
        try {
            $this->repository->update($this->getDataRequest($request, $entity), $entity->id);
            return redirect()->route('admin.' . $this->module . '.index')
                             ->with('resp_success', 'Thực hiện thao tác thành công');
        } catch (Exception $ex) {
            parent::processException($ex);
        }
    }

    public function changeStatus(Request $request)
    {
        return parent::changeStatus($request);
    }

    public function delete(Request $request)
    {
        return parent::bulkDelete($request);
    }

    protected function getDataRequest($request, $entity = null)
    {
        $fileUpload = self::uploadFile($request->file('file'), 'documents');
        $file =  $fileUpload['link_file'] ?? null;
        $fileName =  $fileUpload['name_orgin'] ?? null;

        $data = [
            'name'              => $request->name,
            'no'                => $request->no,
            'epitome'           => $request->epitome,
            'date_issue'        => $request->date_issue,
            'class_document'    => $request->class_document,
            'agency_document'   => $request->agency_document,
            'field_document'    => $request->field_document,
            'type_document'     => $request->type_document,
            'active'            => $request->active ?? false,
            'order'             => $request->order ?? 0
        ];  

        if ($file !== null) {
            $data['file'] = $file;
            $data['file_name'] = $fileName;
            if ($entity && $entity->file) {
                deleteFile($entity->file);
            }
        } elseif ($entity) {
            $data['file'] = $entity->file;
            $data['file_name'] = $entity->file_name;
        }

        return $data;
    }

    private function formData(Entity $entity)
    {
        return [
            'result'       => $entity,
            'module'       => $this->module,
            'classs'       => $this->infoDocumentRepository->typeInfoDocuments(InfoDocument::CLASS_DOCUMENT),
            'types'        => $this->infoDocumentRepository->typeInfoDocuments(InfoDocument::TYPE_DOCUMENT),
            'fields'       => $this->infoDocumentRepository->typeInfoDocuments(InfoDocument::FIELD_DOCUMENT),
            'agencies'     => $this->infoDocumentRepository->typeInfoDocuments(InfoDocument::AGENCY_DOCUMENT),
        ];
    }
}   