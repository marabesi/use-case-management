app.controller('PreviewController', ['$scope', 'StepFactory', 'ApplicationFactory', '$window',
  function($scope, StepFactory, ApplicationFactory, $window) {
    ApplicationFactory.fetch().then(function(data) {
      $scope.application = data.data;
    });

    $scope.build = function() {
      var id = $scope.preview.application;

      StepFactory.preview(id).then(function(response) {
        $scope.previewData = response.data;
        $scope.drawDiagram(response.data)
      });
    };

    $scope.drawDiagram = function(data) {
      $window.$('#useCaseDiagram').empty();

      var usecaseDiagram = new $window.UMLUseCaseDiagram({
        id: 'useCaseDiagram',
        width: $window.innerWidth - 260,
        height: $window.innerHeight - 260
      });
  
      var subsystem = new $window.UMLSubSystem({ x:155, y:40 });
  
      subsystem.setHeight( 250 );
  
      subsystem.setName(data.app.nome);
  
      usecaseDiagram.addElement(subsystem);

      let filterActors = data.app.useCase.map(usecase => usecase.revision.actors.map(actor => {
        actor.belongsTo = usecase.id_caso_de_uso;
        return actor;
      }));

      filterActors = _.flatMap(filterActors);

      const actorsToDraw = _.groupBy(filterActors, 'id_ator')

      const usedActors = [];
      let y = 0;
      for (let actor in actorsToDraw) {
        console.log(actorsToDraw[actor]);

        // var customerActor = new $window.UMLActor({ x: 50, y: y + 50 });
        // usecaseDiagram.addElement(customerActor);
        // customerActor.setName(actor.nome);

        // usedActors.push({
        //   actor: customerActor,
        // });
        // y += 100;
      }
      console.log(usedActors)

      y = 0;
      for (let useCase of data.app.useCase) {
        var useCasePay = new $window.UMLUseCase({ x:170, y: y + 80 });
        useCasePay.setName(useCase.descricao);
        usecaseDiagram.addElement(useCasePay);
  
        for (let availableActor of usedActors) {
          if (availableActor.useCase === useCase.id_caso_de_uso) {
            var communication1 = new $window.UMLCommunication({ b: availableActor.actor, a: useCasePay });
            usecaseDiagram.addElement(communication1);
          }
        }
  
        y += 100
      }
  
      usecaseDiagram.draw();
      usecaseDiagram.interaction(true);
    }

    $scope.drawDiagram({ "app": { "id_sistema": 1390, "nome": "Testable v1.0 - mackenzie", "useCase": [{ "id_caso_de_uso": 8, "id_sistema": 1390, "descricao": "Registrar", "status": 1, "pre_condicao": "Fornecer nome, email e senha.", "pos_condicao": null, "revision": { "id_revisao": 8, "id_dados_revisao": 5, "actors": [{ "id_relacionamento_dados_revisao": 9, "id_ator": 16, "nome": "Usu\u00e1rio", "descricao": "Perfil de usu\u00e1rio comum, gerado para fazer o fluxo como aluno" }], "flow": [{ "complementary": [], "business": [], "reference": [] }] } }, { "id_caso_de_uso": 9, "id_sistema": 1390, "descricao": "Login", "status": 1, "pre_condicao": "Possuir uma conta registrada previamente na ferramenta gamificada", "pos_condicao": null, "revision": { "id_revisao": 9, "id_dados_revisao": 1, "actors": [{ "id_relacionamento_dados_revisao": 10, "id_ator": 16, "nome": "Usu\u00e1rio", "descricao": "Perfil de usu\u00e1rio comum, gerado para fazer o fluxo como aluno" }], "flow": [{ "complementary": [], "business": [], "reference": [] }] } }, { "id_caso_de_uso": 10, "id_sistema": 1390, "descricao": "Gerenciar usu\u00e1rios", "status": 1, "pre_condicao": null, "pos_condicao": null, "revision": { "id_revisao": 10, "id_dados_revisao": 5, "actors": [{ "id_relacionamento_dados_revisao": 11, "id_ator": 17, "nome": "Administrador", "descricao": "Perfil que administra os recursos" }], "flow": [{ "complementary": [], "business": [], "reference": [] }] } }, { "id_caso_de_uso": 11, "id_sistema": 1390, "descricao": "Gerenciar relat\u00f3rio", "status": 1, "pre_condicao": null, "pos_condicao": null, "revision": { "id_revisao": 11, "id_dados_revisao": 5, "actors": [{ "id_relacionamento_dados_revisao": 12, "id_ator": 17, "nome": "Administrador", "descricao": "Perfil que administra os recursos" }], "flow": [{ "complementary": [], "business": [], "reference": [] }] } }] } })
  }]);