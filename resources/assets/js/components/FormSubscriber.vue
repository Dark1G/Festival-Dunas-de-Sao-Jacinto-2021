<template>
	<div>
		<form v-if="showform" @submit.prevent="submitData">
			<div class="form-group">
				<label>Nome Completo *</label>
				<input type="text" class="form-control" v-model="form.nome" required />
				<div v-if="errors.nome"><span v-for="msg in errors.nome">{{ msg }}</span></div>
			</div>
			<div class="form-group">
				<div class="form-row">
					<div class="col">
						<label>E-mail *</label>
						<input type="email" class="form-control" v-model="form.email" required />
						<div v-if="errors.email"><span v-for="msg in errors.email">{{ msg }}</span></div>
					</div>
					<div class="col">
						<label>BI/CC ou Passaporte *</label>
						<input type="text" class="form-control" v-model="form.documento_id" required />
						<div v-if="errors.documento_id"><span v-for="msg in errors.documento_id">{{ msg }}</span></div>
					</div>
				</div>
			</div>

				<div class="row">
					<div class="col mt-4 mb-3">
						<h4 class="alert-heading mb-0">Acompanhantes:</h4>
						<!-- <small>* Preenchimento Obrigatório</small> -->
					</div>
				</div>

				<div v-if="(limit - 1) > 0">

					<div class="form-group">
						<select class="custom-select" v-model="form.numero_acompanhante">
							<option :value="0">Sem Acompanhante</option>
							<option :value="1">Com acompanhante</option>
						</select>
					</div>

					<div v-for="(acompanhante, index) in this.form.numero_acompanhante" :key="index">
						<div class="form-group">
							<label>Nome Completo do Acompanhante *</label>
							<input type="text" class="form-control" v-model="form.nome_acompanhante" required />
							<!-- <div v-if="errors.nome"><span v-for="msg in errors.nome">{{ msg }}</span></div> -->
						</div>
					</div>
				</div>
				<div v-else>
					<div class="alert alert-warning" role="alert">
						Só exite uma vaga não pode levar acompanhante!
					</div>		
				</div>
			
			<div class="form-group" v-if="day==20 || day==21">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" v-model="form.concerto1" id="defaultCheck8" required>
					<label class="form-check-label" for="defaultCheck8">
						<b>Tomei conhecimento que devo proceder ao levantamento do/s meu/s bilhete/s somente entre as 19h30 e as 20h30 no dia do concerto e na bilheteira do recinto, mediante apresentação do meu documento de identificação, utilizado aquando da inscrição.</b>
					</label>
				</div>
			</div>

			<div class="form-group" v-if="day==22">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" v-model="form.concerto2" id="defaultCheck9" required>
					<label class="form-check-label" for="defaultCheck9">
						<b>Tomei conhecimento que devo proceder ao levantamento do/s meu/s bilhete/s somente entre as 16h30 e as 17h30 no dia do concerto e na bilheteira do recinto, mediante apresentação do meu documento de identificação, utilizado aquando da inscrição.</b>
					</label>
				</div>
			</div>

			<div class="form-group">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" v-model="form.dgs" id="defaultCheck4" required>
					<label class="form-check-label" for="defaultCheck4">
						Aceito as condições:
					</label>
					<p>
						<ul>
							<li>Usar sempre máscara, tal como o cumprimento das restantes normas recomendadas pela DGS.</li>
							<li>Autorizar a medição de temperatura na entrada do recinto por elementos do staff, sem registo da mesma.</li>
							<li>Transmitir ao/a meu/minha acompanhante do concerto (caso haja) as normas de utilização.</li>
							<li>Respeitar o distanciamento social.</li>
							<li>Desinfetar as mãos à entrada do recinto e, caso necessário, dentro do recinto.</li>
							<li>Ocupar o lugar atribuído dentro do recinto</li>
							<li>Os lugares serão atribuídos por ordem de Chegada.</li>
							<li>Os lugares serão atribuídos através de cadeiras, sendo permitido estar de pé, sem se afastar da mesma.</li>
						</ul>
					</p>
				</div>
			</div>

			<div class="form-group">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" v-model="form.termos" id="defaultCheck1" required>
					<label class="form-check-label" for="defaultCheck1">
						Aceito os 
						<a href="#" data-toggle="modal" data-target=".bd-example-modal-lg">
							<b>Termos de Participação</b>
						</a>
					</label>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">
						Declaro que tomei conhecimento das condições de participação nos concertos
						inseridos no Festiva Dunas de São Jacinto 2021
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Será considerado um formulário de inscrição por pessoa.</p>
					<p>Cada pessoa poderá inscrever-se uma vez em cada atividade.</p>
					<p>A participação na atividade só será permitida se apresentado o documento de identificação do
					participante que foi indicado no momento da inscrição.</p>
					<p>O participante declara que tem conhecimento e cumprirá as normas de distanciamento social
					decretadas pela DGS bem como a restantes recomendações.</p>
					<p><b>PROTEÇÃO DE DADOS:</b> O signatário autoriza a recolha e o tratamento dos seus dados pessoais
					pelo Município de Aveiro que os utilizará exclusivamente para a gestão das inscrições nos
					concertos integrados na programação do Festival Dunas de São Jacinto 2021.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
					<button type="button" class="btn btn-primary" @click.prevent="termos">Aceito</button>
				</div>
				</div>
			</div>
		</div>

			<div class="alert alert-danger" role="alert" v-if="errorMessage">
			  {{ errorMessage }}
			</div>

			<button class="btn btn-primary" type="button" disabled v-if="this.loading">
			  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
			  Loading...
			</button>
			<button type="submit" class="btn btn-primary mb-2" v-else>Inscrever</button>


		</form>
		<template v-if="!showform">
			<div class="alert alert-success" role="alert" v-if="successMessage">
				{{ successMessage }}
			</div>
		</template>
	</div>
</template>

<script>
	const formEvento = {
		nome: '',
		documento_id: '',
		email: '',
		numero_acompanhante: 0,
		nome_acompanhante: '',
		termos: false,
		dgs: false,
		concerto1: false,
		concerto2: false
	};
	
	const formErrors = {
		nome: null,
		documento_id: null,
		email: null
	};

	export default {
		props: {
			limit: {
				required: true,
				type: Number
			},
			evento:{
				required: true,
			},
			route: {
				required: true
			},
			day:{
				required: true,
			}
		},
		data() {
			return {
				form: {
					numero_acompanhante: 0,
					termos: false,
					dgs: false,
					concerto1: false,
					concerto2: false
				},
				successMessage: null,
				errorMessage: null,
				loading: false,
				errors: {},
				showModal: false,
				showform: true
			}
		},
		created() {
			this.clearForm()
		},
		methods: {
			submitData() {
				this.loading = true
				axios.post(this.route, this.form)
					.then(({ data }) => {
						this.loading = false

						if (data.error) {
							this.errorMessage = data.mensagem
							return;
						}

						this.successMessage = data.mensagem
						this.clearForm()
						this.showform = false

					})
					.catch((err) => {
						this.loading = false 
						console.warn(err)
						if (err.response.data.errors) {
							this.errors = err.response.data.errors;
						}
					})
			},
			clearForm() {
				this.form = Object.assign(this.form, formEvento)
				this.errors = Object.assign(this.errors, formErrors)
				this.errorMessage = null
			},
			termos() {
				this.form.termos=true
				$('.bd-example-modal-lg').modal('hide')
			}
		}
	}

</script>