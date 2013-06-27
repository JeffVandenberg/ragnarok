<?php
App::uses('AppController', 'Controller');
/**
 * AspectTypes Controller
 *
 * @property AspectType $AspectType
 */
class AspectTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AspectType->recursive = 0;
		$this->set('aspectTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AspectType->exists($id)) {
			throw new NotFoundException(__('Invalid aspect type'));
		}
		$options = array('conditions' => array('AspectType.' . $this->AspectType->primaryKey => $id));
		$this->set('aspectType', $this->AspectType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AspectType->create();
			if ($this->AspectType->save($this->request->data)) {
				$this->Session->setFlash(__('The aspect type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The aspect type could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AspectType->exists($id)) {
			throw new NotFoundException(__('Invalid aspect type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->AspectType->save($this->request->data)) {
				$this->Session->setFlash(__('The aspect type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The aspect type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('AspectType.' . $this->AspectType->primaryKey => $id));
			$this->request->data = $this->AspectType->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->AspectType->id = $id;
		if (!$this->AspectType->exists()) {
			throw new NotFoundException(__('Invalid aspect type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AspectType->delete()) {
			$this->Session->setFlash(__('Aspect type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Aspect type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
