# Attaching

Symfony-oriented attachment component for Smart Responsor.

## Current scope
- package-oriented attachment and attachment-link business logic
- inward-only persistence layer under `src/Entity/`
- mirrored `Service/` and `ServiceInterface/`
- local storage driver baseline
- embedded test application under `tests/Application/` instead of standalone root app bootstrap
- QA scaffolding: PHP CS Fixer, PHPStan, PHPUnit

## Package identity
- Composer package: `attaching/attachment`
- Component identity: **Attaching**
- Business object vocabulary: **attachment**
- Root namespace: `App\Attaching`

## Runtime baseline
- PHP `^8.4`
- Symfony `^8.0`
- Doctrine ORM `^3.3`

## Quality gates
- `composer phpstan -- --no-progress`
- `composer test -- --no-coverage`
- `composer cs:check -- --using-cache=no`

## Package surface
- Bundle class: `App\Attaching\AttachingBundle`
- Extension class: `App\Attaching\DependencyInjection\AttachmentExtension`
- Host service import: `config/component/services.yaml`
- Host route import: `config/component/routes.yaml`

## Release surface
- Changelog: `CHANGELOG.md`
- Release process: `docs/release/release-process.adoc`

## Documentation surface
- Antora producer descriptor: `docs/antora.yml`
- Narrative pages: `docs/modules/ROOT/pages/`
- GitHub-facing landing remains in `README.md`
